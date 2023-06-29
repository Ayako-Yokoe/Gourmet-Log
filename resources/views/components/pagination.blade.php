@if ($paginator->lastPage() > 1)

<div class="flex justify-end">
    <ul class="flex items-center space-x-2">

        <li>
            <a 
                href="{{ $paginator->previousPageUrl() }}"
                class="px-2 py-1 rounded-md bg-gray-200 text-gray-700 {{ $paginator->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
            >
                &lt;
            </a>
        </li>


        @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
        <li>
            <a 
                href="{{ $url }}"
                class="px-2 py-1 rounded-md bg-gray-200 text-gray-700 {{ $page == $paginator->currentPage() ? 'font-semibold bg-gray-400 text-white' : '' }}"
            >
                {{ $page }}
            </a>
        </li>
        @endforeach


        <li>
            <a 
                href="{{ $paginator->nextPageUrl() }}"
                class="px-2 py-1 rounded-md bg-gray-200 text-gray-700 {{ $paginator->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}"
            >
                &gt;
            </a>
        </li>

    </ul>
</div>
@endif
