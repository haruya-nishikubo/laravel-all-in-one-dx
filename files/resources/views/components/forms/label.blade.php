<label>
    @if (isset($required) && $required)
        <span class="text-red-500">*</span>
    @endif
    <span class="text-gray-700 font-semibold">{{ $title }}</span>

    {{ $slot }}
</label>
