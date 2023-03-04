<input {{ $attributes->class('form-input w-full mt-2 rounded-md focus:border-indigo-600') }}>

@php ($key = str_replace(['[', ']'], ['.', ''], $attributes->get('name')))

@if ($errors->has($key))
    <ul class="list-disc ml-4 mt-2">
        @foreach($errors->get($key) as $error)
            <li class="text-red-500 text-sm">{{ $error }}</li>
        @endforeach
    </ul>
@endif
