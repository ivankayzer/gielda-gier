<div class="d-flex align-items-center job-listing-items">
    <div class="transaction-item-wrapper">
        <h4>{{ $transaction->seller->name === auth()->user()->name ? 'Ty' : $transaction->seller->name }}</h4>
        <div>
            <img class="transaction-item" src="{{ $transaction->offer->game->cover }}"
                 alt="{{ $transaction->offer->game->title }}"
                 data-tippy data-tippy-placement="top" data-tippy-theme="light"
                 title="{{ $transaction->offer->game->title }} na {{ $transaction->offer->platform() }}">
        </div>
    </div>

    <div class="transaction-item-wrapper">
        <h4>{{ $transaction->buyer->name === auth()->user()->name ? 'Ty' : $transaction->buyer->name }}</h4>
        <div class="transaction-items">
            <div>
                @if($transaction->buyerGame)
                    <img class="transaction-item" src="{{ $transaction->buyerGame->cover }}"
                         alt="{{ $transaction->buyerGame->title }}"
                         data-tippy data-tippy-placement="top" data-tippy-theme="light"
                         title="{{ $transaction->buyerGame->title }} na {{ $transaction->buyerPlatform() }}">
                @endif
            </div>
            @if($transaction->price)
                <div class="transaction-price-wrapper transaction-item-wrapper">
                    <span>{{ $transaction->formatted_price }}</span>
                    <i class="icon-feather-dollar-sign transaction-price"></i>
                </div>
            @endif
        </div>
    </div>
</div>