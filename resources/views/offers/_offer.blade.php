<div class="freelancer">

    <!-- Overview -->
    <div class="freelancer-overview">
        <div class="freelancer-overview-inner">

            <!-- Bookmark Icon -->
            <span class="bookmark-icon"></span>

            <!-- Avatar -->
            <div class="freelancer-avatar">
                <a href="{{ route('offers.show', ['offer' => $offer->id, 'slug' => str_slug($offer->game->title)]) }}"><img
                            src="{{ $offer->game->cover }}" alt=""></a>
            </div>

            <!-- Name -->
            <div class="freelancer-name">
                <h4>
                    <a href="{{ route('offers.show', ['offer' => $offer->id, 'slug' => str_slug($offer->game->title)]) }}">{{ $offer->game->title }} {!! $offer->flag() !!}</a>
                </h4>
                <h6>
                    <mark class="color {{ $offer->platform }}">{{ $offer->platform() }}</mark>
                </h6>

                <div class="d-flex align-items-center margin-top-5">
                    <a href="{{ route('profile.show', ['user' => $offer->seller->name]) }}"
                       class="seller-name margin-right-15">
                        {{ $offer->seller->name }}
                    </a>
                    <div class="freelancer-rating">
                        <i class="icon-material-outline-thumb-up positive-review"></i> <span
                                class="positive-review">{{ $offer->seller->positiveReviewsCount() }}</span>
                        <i style="margin-left: 7px;" class="icon-material-outline-thumb-down negative-review"></i> <span
                                class="negative-review">{{ $offer->seller->negativeReviewsCount() }}</span>
                    </div>
                </div>

                <div class="offer-location">
                    <strong><i class="icon-material-outline-location-on"></i>
                        {{ $offer->city() }}</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Details -->
    <div class="freelancer-details">
        @if($offer->sellable)
            <div class="offer-details">
                <div class="offer-price">
                    <strong>{{ $offer->price() }}</strong>
                </div>
            </div>
        @endif
        <p class="margin-top-5"><i class="icon-material-outline-access-time"></i>
            {{ $offer->publish_at->diffForHumans() }}</p>

        @if($offer->actionable())
            <a href="{{ route('offers.show', ['offer' => $offer->id, 'slug' => str_slug($offer->game->title)]) }}"
               class="button button-sliding-icon ripple-effect">{{ $offer->buyText() }}
                <i class="icon-material-outline-arrow-right-alt"></i></a>
        @endif
    </div>
</div>