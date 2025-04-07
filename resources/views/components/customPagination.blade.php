@if ($paginator->hasPages())

    <nav aria-label="Page navigation example">

        <ul class="pagination justify-content-center">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link"><span>Anterior</span></a>
                </li>
            @else
                <li class="page-item ">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Anterior</a>
                </li>
            @endif


            {{-- Páginas --}}
            @foreach ($elements as $element)

                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif

                @endforeach

            @endforeach

            {{-- Siguiente --}}
            @if (!$paginator->hasMorePages())
            <li class="page-item disabled">
                <a class="page-link"><span>Próxima</span></a>
            </li>
            @else
                <li class="page-item ">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Próxima</a>
                </li>
            @endif

        </ul>

    </nav>

@endif
