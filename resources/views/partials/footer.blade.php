<div class="footer">
    <div class="container">
        <div class="footer-content">
            <span>
                {{ trans('app.Copyright') }} {{ date('Y') }} &copy; {{ trans('app.All Rights Reserved') }}
                {{ conf('app_name') }}
            </span>
            <ul class="social-links">
                <li>
                    <a href="{{(conf('facebook'))?:'#'}}" target="_blank" class="nav-link">
                        <i class="fab fa-2x fa-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="{{(conf('twitter'))?:'#'}}" target="_blank" class="nav-link">
                        <i class="fab fa-2x fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="{{(conf('linkedin'))?:'#'}}" target="_blank" class="nav-link">
                        <i class="fab fa-2x fa-linkedin"></i>
                    </a>
                </li>
                <li>
                    <a href="{{(conf('youtube'))?:'#'}}" target="_blank" class="nav-link">
                        <i class="fab fa-2x fa-youtube"></i>
                    </a>
                </li>
            </ul>

        </div>

    </div>
    <div class="container text-center">
        <a href="{{lang()}}/terms">{{trans('app.Terms and conditions')}}</a> |
        <a href="{{lang()}}/privacy">{{trans('app.Privacy policy')}}</a>
    </div>
</div>


