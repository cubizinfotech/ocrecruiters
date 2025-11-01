@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex justify-left items-center space-x-2 mt-6">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 text-gray-400 cursor-not-allowed">
                <img src="{{ asset('img/page-prev.svg') }}" alt="Previous" class="w-20 h-20 object-contain opacity-50" />
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 hover:bg-indigo-200">
                <img src="{{ asset('img/page-prev.svg') }}" alt="Previous" class="w-20 h-20 object-contain" />
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Dots --}}
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif

            {{-- Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-800 font-bold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="flex items-center justify-center w-10 h-10 rounded-full text-gray-500 hover:bg-indigo-50 hover:text-indigo-700">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 hover:bg-indigo-200">
                <img src="{{ asset('img/page-next.svg') }}" alt="Next" class="w-20 h-20 object-contain opacity-50" />
            </a>
        @else
            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 text-gray-400 cursor-not-allowed">
                <img src="{{ asset('img/page-next.svg') }}" alt="Next" class="w-20 h-20 object-contain" />
            </span>
        @endif
    </nav>
@endif
