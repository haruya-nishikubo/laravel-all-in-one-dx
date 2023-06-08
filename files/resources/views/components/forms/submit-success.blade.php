<button {{ $attributes->class(['inline-block px-6 py-3 rounded-md font-medium tracking-wide bg-success-600 text-light-100 hover:bg-success-500'])->merge(['type' => 'submit']) }}>{{ $slot }}</button>
