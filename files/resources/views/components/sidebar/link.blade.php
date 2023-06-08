@props(['active'])
<a {{ $attributes->class(['flex items-center px-4 py-2 rounded-md', 'text-dark-600 bg-dark-200' => $active, 'text-dark-100 hover:bg-dark-200 hover:text-dark-600' => ! $active]) }}>
    <span class="mx-4 font-medium">{{ $slot }}</span>
</a>
