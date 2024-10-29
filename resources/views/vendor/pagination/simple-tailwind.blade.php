@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
    {{-- Previous Page Link !!}
    --}}
    @if ($paginator->onFirstPage())
    <span
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-800 border border-gray-300 cursor-default leading-5 rounded-md">
        السابق
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-700 border border-gray-300 leading-5 rounded-md hover:text-white focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-700 active:text-white transition ease-in-out duration-150">
        السابق </a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}"
        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-gray-700 border border-gray-300 leading-5 rounded-md hover:text-white focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-700 active:text-white transition ease-in-out duration-150">
        التالي
    </a>
    @else
    <span
        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-gray-800 border border-gray-300 cursor-default leading-5 rounded-md">
        التالي
    </span>
    @endif
</nav>
@endif