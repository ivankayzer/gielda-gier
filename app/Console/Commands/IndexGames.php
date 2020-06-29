<?php

namespace App\Console\Commands;

use App\Game;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class IndexGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index games';

    protected $countUrl = 'https://api-endpoint.igdb.com/games/count/?filter[release_dates.date][gt]=2010-01-01&filter[release_dates.date][lte]=%s&filter[release_dates.platform][any]=48,49,9,130,12&filter[category][eq]=0&filter[cover.cloudinary_id][exists]&filter[version_parent][not_exists]';

    protected $url = 'https://api-endpoint.igdb.com/games/?filter[release_dates.date][gt]=2010-01-01&filter[release_dates.date][lte]=%s&filter[release_dates.platform][any]=48,49,9,130,12&filter[category][eq]=0&filter[cover.cloudinary_id][exists]&fields=id,name,slug,url,cover.cloudinary_id,platforms,first_release_date,screenshots&filter[version_parent][not_exists]&limit=50&offset=%s';

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * Create a new command instance.
     *
     * @param Client $httpClient
     */
    public function __construct()
    {
        parent::__construct();

        $this->httpClient = new Client(['headers' => ['user-key' => getenv('IGDB_API_KEY')]]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $endDate = Carbon::now()->addMonth(1)->endOfMonth()->format('Y-m-d');

        $count = data_get(
            json_decode($this->httpClient->get(sprintf($this->countUrl, $endDate))->getBody()->getContents(), true),
            'count',
            0
        );

        for ($offset = 0; $offset < $count; $offset += 50) {
            $url = sprintf($this->url, $endDate, $offset);

            $games = json_decode($this->httpClient->get($url)->getBody()->getContents(), true);

            $games = collect($games);
            $ids = $games->pluck('id');

            $inDatabase = Game::whereIn('igdb_id', $ids)->pluck('igdb_id')->toArray();

            $games->filter(function ($game) use ($inDatabase) {
                return !in_array($game['id'], $inDatabase);
            })->each(function ($game) {
                $screenshots = collect(data_get($game, 'screenshots', []));
                $screenshots = $screenshots->reduce(function ($carry, $item) {
                    if (!isset($item['width'])) {
                        return $carry;
                    }

                    return $item['width'] > $carry['width'] ? $item : $carry;
                });

                $newGame = new Game([
                    'igdb_id'      => data_get($game, 'id'),
                    'title'        => data_get($game, 'name'),
                    'slug'         => data_get($game, 'slug'),
                    'url'          => data_get($game, 'url'),
                    'cover'        => data_get($game, 'cover.cloudinary_id'),
                    'release_date' => data_get($game, 'first_release_date'),
                    'platforms'    => data_get($game, 'platforms'),
                    'background'   => collect($screenshots)->get('cloudinary_id'),
                ]);

                $newGame->save();
            });
        }
    }
}
