

    {{-- <ul class="pagination_nav">
        <li class="active"><a href="#!">01</a></li>
        <li><a href="#!">02</a></li>
        <li><a href="#!">03</a></li>
        <li class="prev_btn">
            <a href="#!"><i class="fal fa-angle-left"></i></a>
        </li>
        <li class="next_btn">
            <a href="#!"><i class="fal fa-angle-right"></i></a>
        </li>
    </ul> --}}


    @if ($paginator->hasPages())
    <ul class="pagination_nav">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item pagination active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="page-item disabled prev_btn" aria-disabled="true">
                    <span class="page-link" aria-hidden="true"> <i class="fal fa-angle-left"></i></span>
                </li>
            @else
                <li class="page-item prev_btn">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fal fa-angle-left"></i></a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item next_btn">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" ><i class="fal fa-angle-right"></i></a>
                </li>
            @else
                <li class="page-item disabled next_btn" aria-disabled="true">
                    <span class="page-link" aria-hidden="true"><i class="fal fa-angle-right"></i></span>
                </li>
            @endif
        </ul>

@endif


