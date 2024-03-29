@if(session('success'))
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-success-100 border-l-4 border-success-500 text-success-700 p-4">
                <p>{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if(session('failure'))
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-danger-100 border-l-4 border-danger-500 text-danger-700 p-4">
                <p>{{ session('failure') }}</p>
            </div>
        </div>
    </div>
@endif
