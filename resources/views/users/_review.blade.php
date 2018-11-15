<li class="review-{{ $review->type }}">
    <div class="boxed-list-item">
        <div class="item-content">
            <h4>
                @if($review->type === 'positive')
                    <i class="icon-material-outline-thumb-up positive-review"></i>
                @elseif($review->type === 'negative')
                    <i class="icon-material-outline-thumb-down negative-review"></i>
                @endif
                {!! \App\Services\SentenceComposer::revieweeTransactionText($review->transaction) !!}
            </h4>
            <div class="item-details margin-top-10">
                <div class="detail-item"><i class="icon-material-outline-date-range"></i>
                    {{ $review->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="item-description">
                <p>{{ $review->comment }}</p>
            </div>
        </div>
    </div>
</li>