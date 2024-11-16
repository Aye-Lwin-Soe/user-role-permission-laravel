<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-2 bg-light p-3 sidebar">
                @include('layout.sidebar')
            </div>

            <div class="col-md-8 offset-2 col-lg-10 p-4">

                @foreach(['success', 'info', 'warning', 'danger'] as $msg)
                @if(session($msg))
                <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert" id="alert-{{ $msg }}">
                    {{ session($msg) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @endforeach

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 10000);
    </script>
</body>

</html>