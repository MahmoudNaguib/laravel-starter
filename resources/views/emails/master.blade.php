<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>
</head>
<body style="font-family: sans-serif; padding: 15px;">
<div class="wrapper">
    <div class="header" style="width: 100%">
        <a href="{{App::make("url")->to('/')}}" style="margin-left: auto;
  margin-right: auto;
  display: block;">
            <img src="{{app()->make("url")->to('/')}}/uploads/small/{{(conf('logo'))?:'logo.png'}}" alt="{{ appName() }}" style="margin-left: auto;
  margin-right: auto;
  height: 60px;
  display: block;">
        </a>
    </div>
    <div class="body" style="color: #000000;
            font-size: 14px; margin-top: 25px; margin-bottom: 50px;">
        <h3 style="text-align: center;">@yield('title')</h3>
        @yield('content')
    </div>

    <div class="footer" style="text-align: center;
            width: 100%;
            color: #999999;
            font-size: 12px; margin-top: 50px;">
        {{ trans('email.Copyright') }} {{date("Y")}} ©
        <a href="{{App::make("url")->to('/')}}" style="color:#999999;">
            {{ appName() }}
        </a>
    </div>
</div>


</body>
</html>
