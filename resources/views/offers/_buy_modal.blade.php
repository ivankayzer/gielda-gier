<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs buy-dialog">
    <div class="sign-in-form">
        <ul class="popup-tabs-nav">
            @if($offer->sellable)
                <li><a href="#buy">@lang('offers.buy')</a></li>
            @endif

            @if($offer->tradeable)
                <li><a href="#trade">@lang('offers.trade')</a></li>
            @endif
        </ul>

        <div class="popup-tabs-container">

        @if ($offer->sellable)
            <!-- Buy -->
                <div class="popup-tab-content" id="buy">

                    <form action="{{ route('transactions.create') }}" method="post">
                        @csrf
                        <div class="welcome-text">
                            <input type="hidden" value="{{ $offer->id }}" name="offer_id">
                            <input type="hidden" value="{{ \App\ValueObjects\TransactionType::PURCHASE }}" name="type">
                            <span>@lang('offers.you_are_buying')</span>
                            <h3>{{ $offer->game->title }}</h3>
                            <span>{{ $offer->platform() }}</span>
                            <span>@lang('offers.for')</span>
                            <h3>{{ $offer->price() }}</h3>
                        </div>

                        <button class="button full-width button-sliding-icon ripple-effect" type="submit">
                            @lang('offers.buy')
                            <i class="icon-material-outline-arrow-right-alt"></i>
                        </button>
                    </form>
                </div>
        @endif

        @if ($offer->tradeable)
            <!-- Trade -->
                <div class="popup-tab-content" id="trade">

                    <form action="{{ route('transactions.create') }}" method="post">
                    @csrf
                    <!-- Welcome Text -->
                        <div class="welcome-text" style="margin-bottom: 15px;">
                            <input type="hidden" value="{{ $offer->id }}" name="offer_id">
                            <input type="hidden" value="{{ \App\ValueObjects\TransactionType::TRADE }}" name="type">
                            <span>@lang('offers.trade_game')</span>
                            <h3>{{ $offer->game->title }}</h3>
                            <span>{{ $offer->platform() }}</span>
                            <span>@lang('offers.on')</span>
                        </div>

                        <div class="submit-field">
                            <select class="selectpicker-live with-border" data-size="7"
                                    data-live-search="true"
                                    name="game_id"
                                    title="@lang('offers.select_game')">
                            </select>
                        </div>

                        <div class="submit-field">
                            <select class="selectpicker with-border"
                                    data-size="{{ count($platforms) }}"
                                    name="platform"
                                    title="@lang('offers.select_platform')">
                                @foreach($platforms as $key => $platform)
                                    <option value="{{ $key }}">{{ $platform }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-with-icon-left">
                            <i class="icon-material-outline-money"></i>
                            <input type="number" class="input-text with-border" name="money"
                                   placeholder="@lang('offers.money_add')" required/>
                        </div>

                        <button class="margin-top-10 button full-width button-sliding-icon ripple-effect" type="submit">
                            @lang('offers.trade')
                            <i class="icon-material-outline-arrow-right-alt"></i></button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>