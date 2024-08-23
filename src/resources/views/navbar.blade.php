@use(ConnorLock05\LaravelAdmin\Traits\ModifiedByAdminPanel)
@use(Illuminate\Database\Eloquent\Model)
@use(Illuminate\Support\Str)
@php use function ConnorLock05\LaravelAdmin\classes_using_trait; @endphp
<nav class="flex flex-col justify-start items-center w-fit h-full p-4 shadow">
    <span class="font-semibold underline">Models</span>

    @foreach (classes_using_trait(ModifiedByAdminPanel::class) as $class)
        @if (($instance = (new $class)) instanceof Model)
            <a
                href="{{ route('admin.model.index', [base64_encode($class)]) }}"
            >
                {{ Str::headline((new ReflectionClass($class))->getShortName()) }}
            </a>
        @endif
    @endforeach

</nav>