<div class="d-flex justify-content-end mt-3">
    <div class="pagination-wrap hstack gap-2">
        <a class="page-item pagination-prev @if($paginator->onFirstPage()) disabled @endif" href="{{ $paginator->previousPageUrl() }}">
            Previous
        </a>

        <ul class="pagination listjs-pagination mb-0">
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="page-item @if($i == $paginator->currentPage()) active @endif">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
        </ul>

        <a class="page-item pagination-next @if(!$paginator->hasMorePages()) disabled @endif" href="{{ $paginator->nextPageUrl() }}">
            Next
        </a>
    </div>
</div>
