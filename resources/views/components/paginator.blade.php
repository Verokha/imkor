@if ($paginator->hasPages())
    <div class="paginator">
        @if ($paginator->onFirstPage())
            <a href="#" class="disable_href prev current_prev">
                <div class="dot">
                    <svg class="arrow" width="25" height="7" viewBox="0 0 25 7" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M24 3.59259L0.999999 3.59259M0.999999 3.59259L5.85915 6M0.999999 3.59259L5.85915 0.999999"
                            stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="prev">
                <div class="dot">
                    <svg class="arrow" width="25" height="7" viewBox="0 0 25 7" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M24 3.59259L0.999999 3.59259M0.999999 3.59259L5.85915 6M0.999999 3.59259L5.85915 0.999999"
                            stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </a>
        @endif
        <div class="pages">
            @php
                $pages = $paginator->getUrlRange(1, $paginator->lastPage());
                $currentPage = $paginator->currentPage();
                if ($currentPage >= 3) {
                    $slicedPages = array_slice($pages, $currentPage - 2, 3, true);
                } else {
                    $slicedPages = array_slice($pages, 0, 3, true);
                }
            @endphp
            {{-- Pagination Elements --}}
            @foreach ($slicedPages as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="current page" href="#" page="{{ $page }}">{{ $page }}</a>
                @else
                    <a class="page" href="{{ $url }}" page="{{ $page }}">{{ $page }}</a>
                @endif
            @endforeach
            <p class="page">...</p>
            <a class="page" href="{{route('cars.items', ['page' => 'all'])}}">все</a>
            {{-- @foreach ($elements as $element)
                @if (is_string($element))
                    <p>...</p>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="current page" href="#">{{ $page }}</a>
                        @else
                            <a class="page" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach --}}
        </div>
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="next">
                <div class="dot">
                    <svg class="arrow" width="25" height="7" viewBox="0 0 25 7" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 3.40741H24M24 3.40741L19.1408 1M24 3.40741L19.1408 6" stroke="white"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </a>
        @else
            <a class="disable_href next current_prev" href="#">
                <div class="dot">
                    <svg class="arrow" width="25" height="7" viewBox="0 0 25 7" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 3.40741H24M24 3.40741L19.1408 1M24 3.40741L19.1408 6" stroke="white"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </a>
        @endif
    </div>
@endif
