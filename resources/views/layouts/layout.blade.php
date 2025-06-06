<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('basic.site_name') }} / {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('./storage/bootstrap-5.0.2-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('./storage/css/style.css') }}">
    <script src="{{asset('./storage/bootstrap-5.0.2-dist/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('./storage/bootstrap-5.0.2-dist/js/jquery-3.7.1.slim.js')}}"></script>
</head>
<body>
<header class="header">
    <div class="container header_container">
        <span class="header_headline header_home_link"><a href="/" class="header_home_link">{{ __('basic.site_name') }}</a> / {{ $title }}</span>

    </div>
</header>
<section class="messages-section">
    <div class="container messages-container">
        @if($errors->any())
            @foreach($errors as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('danger') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
    </div>
    <!-- /.container messages-container -->
</section>
<!-- /.messages-section -->
<section class="main">
    <div class="container main-container">
        @yield ('content')
    </div>
</section>

<div class="fixed-menu">
    <div class="container fixed-menu_container">
        <a href="{{ route('lists.index') }}" class="fixed-menu_link"><img src="{{ asset('./storage/img/list.svg') }}" alt="list icon"></a>
        <a href="{{ route('flowers.create') }}" class="fixed-menu_link"><img src="{{ asset('./storage/img/plus.svg') }}" alt="plus icon"></a>
        <a href="{{ route('watering.index') }}" class="fixed-menu_link"><img src="{{ asset('./storage/img/droplet.svg') }}" alt="droplet icon"></a>
    </div>
</div>
@include('parts.textAreaResizer')
</body>
</html>
