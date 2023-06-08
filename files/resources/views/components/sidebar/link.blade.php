@props(['active'])
<a {{ $attributes->class(['flex items-center px-4 py-2 rounded-md', 'text-dark-600 bg-primary-300' => $active, 'text-dark-600 hover:bg-primary-200' => ! $active]) }}>
    <span class="mx-4 font-medium">{{ $slot }}</span>
</a>
