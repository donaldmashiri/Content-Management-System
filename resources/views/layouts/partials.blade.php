@if (session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-700 dark:text-green-400">
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

@if (session('error'))
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-300 dark:text-gray-250" role="alert">
    <span class="font-medium">{{ session('error') }}</span>
</div>
@endif


@if($errors->any())
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-300 dark:text-gray-250" role="alert">
    @foreach ($errors->all() as $error)
        <span class="font-medium">  {{ $error }}!</span> 
    @endforeach
</div>
 @endif

