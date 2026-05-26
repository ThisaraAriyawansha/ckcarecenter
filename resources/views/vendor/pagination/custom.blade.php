@if ($paginator->hasPages())
<style>
    .care-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        padding: 8px 0;
    }

    .care-pagination .page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        padding: 0 14px;
        border-radius: 8px;
        border: 1.5px solid #dee2e6;
        background: #fff;
        color: #0d6efd;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        line-height: 1;
    }

    .care-pagination .page-btn:hover {
        background: #e7f0ff;
        border-color: #0d6efd;
        color: #0d6efd;
        text-decoration: none;
    }

    .care-pagination .page-btn.active {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
        cursor: default;
        pointer-events: none;
    }

    .care-pagination .page-btn.disabled {
        opacity: 0.4;
        cursor: not-allowed;
        pointer-events: none;
        background: #f8f9fa;
        color: #6c757d;
    }

    .care-pagination .page-btn.dots {
        border-color: transparent;
        background: transparent;
        cursor: default;
        pointer-events: none;
        color: #6c757d;
        min-width: 32px;
        padding: 0 4px;
    }

    .care-pagination .nav-btn {
        gap: 5px;
        font-weight: 600;
        padding: 0 16px;
    }

    @media (max-width: 768px) {
        .care-pagination-wrapper {
            margin-bottom: 48px;
        }
    }

    @media (max-width: 576px) {
        .care-pagination .page-btn {
            min-width: 36px;
            height: 36px;
            font-size: 0.82rem;
            padding: 0 10px;
        }
        .care-pagination .nav-label {
            display: none;
        }
    }
</style>

<nav aria-label="Blog pagination" class="care-pagination-wrapper">
    <div class="care-pagination">

        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <span class="page-btn nav-btn disabled" aria-disabled="true">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                <span class="nav-label">Prev</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-btn nav-btn" rel="prev" aria-label="Previous">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>
                <span class="nav-label">Prev</span>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-btn dots" aria-hidden="true">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-btn active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-btn nav-btn" rel="next" aria-label="Next">
                <span class="nav-label">Next</span>
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
            </a>
        @else
            <span class="page-btn nav-btn disabled" aria-disabled="true">
                <span class="nav-label">Next</span>
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
            </span>
        @endif

    </div>

    {{-- Results Info --}}
    <p class="text-center text-muted mt-2" style="font-size: 0.83rem;">
        Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }} articles
    </p>
</nav>
@endif
