<!DOCTYPE html>
<html>
<head>
    @if($page->production)
        @include('_partials.googleAnalytics')
    @endif

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AACTMAD</title>


    {!! $page->fontawesome !!}

    <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
    <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">


    @yield('header')
</head>
<body>

{{--<div class="container is-fluid">--}}
@if ($page->justEvents)
    @include('_partials.eventsNavbar')
@else
    @include('_partials.navbar')
@endif

<div>
    @yield('body')
</div>


@include('_partials.footer')

{{--</div>--}}
</body>
</html>
