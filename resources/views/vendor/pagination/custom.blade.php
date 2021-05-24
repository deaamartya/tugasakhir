<nav>
  <ul class="pagination pagination-gutter pagination-primary no-bg justify-content-end">
      {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <li class="page-item page-indicator" disabled>
            <a class="page-link" href="javascript:void(0)" rel="next">
              <i class="la la-angle-left"></i>
            </a>
          </li>
        @else
          <li class="page-item page-indicator">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
              <i class="la la-angle-left"></i>
            </a>
          </li>
        @endif
      {{-- Pagination Elements --}}
          @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                      <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @else
                      <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
          @endforeach
      {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <li class="page-item page-indicator">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
              <i class="la la-angle-right"></i>
            </a>
          </li>
        @else
        <li class="page-item page-indicator" disabled>
          <a class="page-link" href="javascript:void(0)" rel="next">
            <i class="la la-angle-right"></i>
          </a>
        </li>
        @endif
  </ul>
</nav>