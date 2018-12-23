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

                <div class="d-flex align-items-end margin-top-25 dashboard-box dashboard-box-list transparent">
                    <div class="buttons-to-right always-visible d-flex align-items-end">
                        <a href="#" class="button gray ripple-effect ico" data-tippy-placement="top" data-tippy="" data-original-title="Edit"><i class="icon-feather-edit"></i></a>
                        <a href="#" class="button gray ripple-effect ico" data-tippy-placement="top" data-tippy="" data-original-title="Remove"><i class="icon-feather-trash-2"></i></a>
                    </div>
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

            @if($offer->is_published)
                <span class="dashboard-status-button green">@lang('offers.is_published')</span>
            @else
                <span class="dashboard-status-button red">@lang('offers.not_published')</span>
            @endif
    </div>
</div>