@use(Illuminate\Support\Str)
@use(ConnorLock05\LaravelAdmin\Services\ModelService)
<nav class="flex flex-col justify-start items-center w-fit h-full p-4 shadow">
    <span class="font-semibold underline">Models</span>

    <div class="flex flex-col justify-start items-center gap-y-2 h-fit text-center">
        @foreach ((new ModelService())->getModels() as $class)
            <a
                href="{{ route('admin.model.index', [base64_encode($class)]) }}"
            >
                {{ \ConnorLock05\LaravelAdmin\get_formatted_class_name($class) }}
            </a>
        @endforeach
    </div>

    <span class="font-semibold underline mt-4">Utilities</span>

    <div class="flex flex-col justify-start items-center gap-y-2 h-fit text-center">
        <a href="{{ route('admin.artisan.show') }}">Artisan</a>
    </div>

</nav>