<label>
    @if (isset($requidanger) && $requidanger)
        <span class="text-danger-500">*</span>
    @endif
    <span class="text-dark-700 font-semibold">{{ $title }}</span>

    {{ $slot }}
</label>
