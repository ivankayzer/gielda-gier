@if ($paginator->hasPages())
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <!-- Pagination -->
            <div class="pagination-container margin-top-40 margin-bottom-60">
                <nav class="pagination" role="navigation">
                    <ul>
                        @if (!$paginator->onFirstPage())
                            <li class="pagination-arrow"><a href="{{ $paginator->previousPageUrl() }}"
                                                            class="ripple-effect"><i
                                            class="icon-material-outline-keyboard-arrow-left"></i></a></li>
                        @endif

                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li><a class="ripple-effect">{{ $element }}</a></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li><a class="current-page ripple-effect">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}" class="ripple-effect">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="pagination-arrow"><a rel="next" href="{{ $paginator->nextPageUrl() }}"
                                                            class="ripple-effect"><i
                                            class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endif
