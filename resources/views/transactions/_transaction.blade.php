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
                <p>{!! \App\Services\SentenceComposer::transactionInfo($transaction) !!}</p>
            </div>
        </div>
    </div>

    <!-- Task Details -->
    <ul class="dashboard-task-info">
        <li><span>{{ $transaction->otherPersonType() }}</span><strong><a href="#">{{ $transaction->otherPerson->name }}</a></strong></li>
        <li><span>@lang('offers.location')</span><strong>{{ $transaction->offer->city() }}</strong></li>
    </ul>

@if($transaction->status()->isInProgress())
    <!-- Buttons -->
        <div class="buttons-to-right always-visible">
            <a href="#"
               class="button ripple-effect"><i
                        class="icon-material-outline-supervisor-account"></i>
                @lang('transactions.info')</a>
        </div>
    @endif
</li>
