@if ($paginator->hasPages())
<nav class="smac-pagination-nav" role="navigation" aria-label="Pagination Navigation">
    <div class="smac-pagination-wrap">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="smac-page-btn smac-page-arrow disabled" aria-disabled="true" aria-label="Previous page">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="12 15 7 10 12 5"></polyline>
                </svg>
                <span>Prev</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="smac-page-btn smac-page-arrow" rel="prev" aria-label="Previous page">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="12 15 7 10 12 5"></polyline>
                </svg>
                <span>Prev</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="smac-page-numbers">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="smac-page-ellipsis" aria-disabled="true">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="smac-page-btn smac-page-num active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="smac-page-btn smac-page-num">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="smac-page-btn smac-page-arrow" rel="next" aria-label="Next page">
                <span>Next</span>
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="8 5 13 10 8 15"></polyline>
                </svg>
            </a>
        @else
            <span class="smac-page-btn smac-page-arrow disabled" aria-disabled="true" aria-label="Next page">
                <span>Next</span>
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="8 5 13 10 8 15"></polyline>
                </svg>
            </span>
        @endif
    </div>

    @if($paginator->total() > 0)
    <p class="smac-pagination-summary">
        Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong> of <strong>{{ $paginator->total() }}</strong> articles
    </p>
    @endif
</nav>
@endif

