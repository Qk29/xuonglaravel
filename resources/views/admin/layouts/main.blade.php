<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | ShopComputer</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid">
        <div class="row">
            @include('admin.layouts.partials.sidebar')
            <div class="col-9 offset-3 p-0 position-relative">
                @include('admin.layouts.partials.header')
                <main class="px-4 py-4">
                    @yield('content')
                </main>
                @include('admin.layouts.partials.footer')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>

</html>