<!DOCTYPE html>
<html lang="{{lang()}}" dir="{{(lang()=='en')?'ltr':'rtl'}}">
<head>
    @include('partials.meta')
    @include('partials.css')
    @stack('css')
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/aileron" type="text/css"/>
</head>
<body class="template-color-1">
<div>
    @include('partials.top-header')
    @include('partials.flash_messages')
    <div class="container main-content">
        <div class="row">
            <div class="col-12">
                @include('partials.breadcrumb')
            </div>
        </div>

        <div class="row">
            @yield('title')
        </div>
        <div class="row">
            @yield('content')
        </div>
    </div>
    @stack('modals')
    @include('partials.footer')
</div>
@include('partials.js')
@stack('js')
</body>
</html>
