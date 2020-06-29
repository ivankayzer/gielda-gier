<?php

namespace Tests\Feature;

use App\Offer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function offer_should_have_a_formatted_price()
    {
        $offer = factory(Offer::class)->make([
            'price' => '105,32',
        ]);

        $this->assertEquals('105,32 zł', $offer->formatted_price);
    }

    /** @test */
    public function price_should_be_converted_to_int()
    {
        $offer = factory(Offer::class)->make([
            'price' => '100,31',
        ]);
        $this->assertEquals('10031', $offer->price);

        $offer->price = '10,32';
        $this->assertEquals('1032', $offer->price);

        $offer->price = '1036';
        $this->assertEquals('103600', $offer->price);

        $offer->price = '10.34';
        $this->assertEquals('1034', $offer->price);
    }
}
