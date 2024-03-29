<nav class="rounded-md w-full">
    <ol class="list-reset flex">
        @foreach ($items as $text => $link)
            @if (! empty($link))
                <li><a href="{{ $link }}" class="text-dark-500 px-4 py-2 rounded-md hover:bg-dark-200 font-bold">{{ $text }}</a></li>
                <li><span class="text-dark-500 mx-2">/</span></li>
            @else
                <li class="text-dark-500 mx-2 font-bold">{{ $text }}</li>
            @endif
        @endforeach
    </ol>
</nav>
