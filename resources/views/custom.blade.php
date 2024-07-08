@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Tambahkan tombol navigasi ke halaman sebelumnya --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a wire:click="previousPage" href="#" rel="prev">&laquo;</a></li>
        @endif

        {{-- Tampilkan nomor halaman --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Link ke Halaman --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a wire:click="gotoPage({{ $page }})" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tambahkan tombol navigasi ke halaman berikutnya --}}
        @if ($paginator->hasMorePages())
            <li><a wire:click="nextPage" href="#" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
