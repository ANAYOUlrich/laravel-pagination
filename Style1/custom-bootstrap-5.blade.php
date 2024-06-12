@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                            rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>


        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between row">
            <div class="col-md-6 mb-2">
                <div
                    class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-center justify-content-md-start">
                    <div>

                        <p class="mb-0 text-muted">
                            <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                            {!! __('à') !!}
                            <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                            {!! __('sur') !!}
                            <span class="fw-semibold">{{ $paginator->total() }}</span>
                            {!! __('éléments | Nbre ligne : ') !!}
                        </p>
                    </div>
                    <div>

                        <select id="perPage" name="ligne" class="mx-2 form-control form-control-sm ligne-number"
                            style="width: 60px; height: 28px;">
                            <option value="10" {{ request('ligne') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('ligne') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('ligne') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('ligne') == 100 ? 'selected' : '' }}>50</option>
                            <option value="250" {{ request('ligne') == 250 ? 'selected' : '' }}>50</option>
                            <option value="500" {{ request('ligne') == 500 ? 'selected' : '' }}>50</option>
                        </select>

                        {{-- <input type="number" name="ligne" min="0" max="{{ $paginator->total() }}"
                            value="{{ $paginator->count() }}" placeholder="Ligne" id="ligne"
                            class="ml-2 form-control  form-control-sm ligne-number" style="width: 60px; height: 28px;"> --}}


                    </div>
                </div>
            </div>
            <div class="col-md-6  mb-2">
                <div
                    class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-center justify-content-md-end">
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                    aria-label="@lang('pagination.previous')">&lsaquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled" aria-disabled="true"><span
                                        class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @if (1 < $paginator->currentPage() - 2)
                                    <li class="page-item" aria-current="page"><span class="page-link">...</span></li>
                                @endif
                                @foreach ($element as $page => $url)
                                    @if ($page <= $paginator->currentPage() + 2 && $page >= $paginator->currentPage() - 2)
                                        @if ($page == $paginator->currentPage())
                                            <li class="page-item active" aria-current="page"><span
                                                    class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                                @if ($paginator->lastPage() > $paginator->currentPage() + 2)
                                    <li class="page-item" aria-current="page"><span class="page-link">...</span></li>
                                @endif
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                    aria-label="@lang('pagination.next')">&rsaquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>
                        @endif
                    </ul>

                    <div>
                        <input type="number" name="page" min="1" max="{{ $paginator->lastPage() }}"
                            value="{{ $paginator->currentPage() }}" placeholder="Page" id="page"
                            class="mx-2 form-control form-control-sm" style="width: 60px; height: 28px;">
                    </div>
                    <div>
                        <p class="mb-0 text-muted"> sur {{ $paginator->lastPage() }}</p>
                    </div>




                </div>
            </div>
        </div>
    </nav>
@endif

<script>
    $(document).ready(function() {

        $('.ligne-number').change(function() {
            console.log("ça commence");
            var ligne = $(this).val(); 
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.searchParams.set('ligne', ligne);
            window.location.href = url.toString();
        });

        $("#page").change(function() {
            var page = $(this).val(); 
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.searchParams.set('page', page);
            window.location.href = url.toString();
        })
    })
</script>
