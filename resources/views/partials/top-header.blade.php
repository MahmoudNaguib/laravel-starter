<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{app()->make("url")->to('/')}}">
            <img src="uploads/small/{{conf('logo')}}" height="40" alt="{{conf('app_name')}}"
                 class="d-inline-block align-middle mr-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{app()->make("url")->to('/')}}/{{lang()}}"
                       class="nav-link {{(request()->is('/'))?'active':''}}">
                        {{trans('app.Home')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{lang()}}/posts" class="nav-link {{(request()->is('/posts'))?'active':''}}">
                        {{trans('app.Posts')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{lang()}}/about" class="nav-link {{(request()->is('/about'))?'active':''}}">
                        {{trans('app.About')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{lang()}}/contact" class="nav-link {{(request()->is('/contact'))?'active':''}}">
                        {{trans('app.Contact us')}}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        {{@languages()[lang()]}}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach(languages() as $key=>$lang)
                            <li>
                                <a class="dropdown-item" href="{{urlLang(url()->full(),lang(),$key)}}">
                                    {{$lang}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                @if(auth()->guest())
                    <li class="nav-item dropdown mr-auto">
                        <a class="nav-link dropdown-toggle {{(request()->is('auth/*'))?'active':''}}"
                           href="#" id="navbarDropdown"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            {{trans('app.Login')}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{lang()}}/auth/login"><i
                                        class="fa fa-user"></i>{{trans('app.Login')}}</a>
                            </li>
                            <li><a class="dropdown-item" href="{{lang()}}/auth/register"><i
                                        class="fa fa-key"></i>{{trans('app.Register')}}
                                </a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{(request()->is('profile/*') || request()->is('dashbard'))?'active':''}}"
                           href="#"
                           id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            {{trans('app.Welcome')}} {{str_limit(auth()->user()->name,8)}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{lang()}}/dashboard">
                                    {{trans('app.Dashboard')}}
                                </a>
                            </li>
                            @if(auth()->user()->type=='admin')
                                <li>
                                    <a class="dropdown-item" href="{{lang()}}/admin/posts">
                                        {{trans('app.Posts management')}}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{lang()}}/my-posts">
                                        {{trans('app.My posts')}}
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a class="dropdown-item" href="{{lang()}}/profile/edit">
                                    {{trans('app.Edit account')}}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{lang()}}/profile/change-password">
                                    {{trans('app.Change password')}}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{lang()}}/profile/logout">
                                    {{trans('app.Logout')}}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        @php
                            $notificationsCount=\App\Models\Notification::where('user_id',auth()->user()->id)->unreaded()->count();
                        @endphp
                        <a href="{{lang()}}/notifications"
                           class="nav-link {{(request()->is('notifications*'))?'active':''}}"
                           aria-current="page">
                            <i class="fa fa-bell"></i>
                            <span class="indicator">{{$notificationsCount}}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
