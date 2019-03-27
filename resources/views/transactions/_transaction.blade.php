<li>
    <!-- Job Listing -->
    <div class="job-listing width-adjustment">

        <!-- Job Listing Details -->
        <div class="job-listing-details">

            <!-- Details -->
            <div class="job-listing-description">
                <h3 class="job-listing-title"><a
                            href="#">@lang('transactions.number'){{ $transaction->id }}</a> {!! $transaction->status()->getLabel() !!}
                </h3>

                <!-- Job Listing Footer -->
                <div class="job-listing-footer">
                    <ul>
                        <li>
                            <i class="icon-material-outline-access-time"></i>
                            {{ $transaction->created_at->diffForHumans() }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="d-flex align-items-center">
            </div>
        </div>
    </div>

    <!-- Task Details -->
    <ul class="dashboard-task-info">
        <li><span>{{ $transaction->otherPersonType() }}</span><strong><a href="{{ route('profile.show', ['user' => $transaction->otherPerson->name]) }}">{{ $transaction->otherPerson->name }}</a></strong></li>
        <li><span>@lang('offers.location')</span><strong>{{ $transaction->offer->city()->name }}</strong></li>
    </ul>

@if($transaction->status()->isInProgress())
        <div class="buttons-to-right always-visible">
            <a href=".user-info-dialog" data-id="{{ $transaction->id }}"
               class="button ripple-effect popup-with-zoom-anim open-transaction-data"><i
                        class="icon-material-outline-supervisor-account"></i>
                @lang('transactions.info')</a>
            <a href=".finish-transaction" data-id="{{ $transaction->id }}"
               class="button gray ripple-effect popup-with-zoom-anim open-transaction-data"><i
                        class="icon-material-outline-outlined-flag"></i>
                @lang('transactions.finish')</a>
        </div>
    @endif
</li>
