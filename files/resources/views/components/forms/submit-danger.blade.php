<button {{ $attributes->class(['inline-block px-6 py-3 rounded-md font-medium tracking-wide bg-danger-600 text-light-100 hover:bg-danger-500'])->merge(['type' => 'submit']) }}>{{ $slot }}</button>
