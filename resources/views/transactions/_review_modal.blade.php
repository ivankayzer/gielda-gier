<div id="small-dialog" class="finish-transaction zoom-anim-dialog mfp-hide dialog-with-tabs">
    <div class="sign-in-form">

        <ul class="popup-tabs-nav" style="pointer-events: none;">
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab1" style="">

                <form action="{{ route('transactions.rate') }}" method="post">
                    @csrf
                    <input type="hidden" name="transaction_id">
                    <div class="welcome-text">
                        <h3>@lang('transactions.rate_transaction')</h3>
                    </div>

                    <div class="account-type">
                        <div>
                            <input type="radio" name="type" id="positive-radio"
                                   class="type account-type-radio" checked="" value="positive">
                            <label for="positive-radio" class="ripple-effect-dark"><i
                                        class="icon-material-outline-thumb-up"></i> @lang('transactions.positive')
                            </label>
                        </div>

                        <div>
                            <input type="radio" name="type" id="negative-radio"
                                   class="type account-type-radio" value="negative">
                            <label for="negative-radio" class="ripple-effect-dark red"><i
                                        class="icon-material-outline-thumb-down"></i> @lang('transactions.negative')
                            </label>
                        </div>
                    </div>

                    <textarea class="with-border" placeholder="@lang('transactions.comment')" name="message"
                              id="message" cols="7"></textarea>

                    <button class="button full-width button-sliding-icon ripple-effect" type="submit"
                            style="width: 30px;">@lang('common.send') <i
                                class="icon-material-outline-arrow-right-alt"></i></button>

                </form>
            </div>
        </div>
    </div>
</div>