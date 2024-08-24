<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    height: {
                        'headerless': 'calc(100% - 3rem)',
                    }
                }
            }
        };
    </script>
</head>
<body class="h-screen">
<header class="w-full h-12 p-2 shadow">
    <div class="flex justify-between items-center w-full h-full">
        <a href="{{ route('admin.dashboard') }}">
            <h2 class="font-semibold">{{ config('app.name') }} - Admin Panel</h2>
        </a>
    </div>
</header>
<div class="flex w-full h-headerless">
    <div class="h-full">
        @include('admin::navbar')
    </div>

    <main class="flex flex-col justify-start items-center gap-4 w-full h-full px-4 py-8 bg-gray-100">
        <div class="flex flex-col justify-start items-center gap-4 w-3/4 h-fit p-4 bg-white rounded-lg">
            @yield('content')
        </div>
    </main>
</div>

@stack('scripts')

</body>
</html>