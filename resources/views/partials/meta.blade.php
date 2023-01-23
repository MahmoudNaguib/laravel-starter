<!-- Required meta tags -->
@if (app()->environment() != 'production')
    <meta name="robots" content="noindex">
@endif
<meta charset="utf-8">
<base href="{{app()->make("url")->to('/')}}/" />
<title>{{appName()}} - {{strip_tags(@$page_title)}}</title>
<meta name="description" content="{{@$meta_description}}">
<meta name="keywords" content="{{@$meta_keywords}}">
<meta name="author" content="{{appName()}}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="language" content="English">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta property="og:locale" content="{{(lang() == 'en')?'en_EG':'ar_EG'}}">
<meta property="og:type" content="website">
<link rel="canonical" href="{{App::make("url")->to('/')}}/{{Request::path()}}" />
<meta property="og:title" content="{{appName()}} - {{strip_tags(@$page_title)}}"/>
<meta property="og:url" content="{{App::make("url")->to('/')}}/{{Request::path()}}"/>
<meta property="og:site_name" content="{{appName()}}"/>
<meta property="og:locale" content="{{(lang() == 'en')?'en_EG':'ar_EG'}}">
<meta property="og:description" content="{{@$meta_description}}" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
@if(@$image)
    <meta property="og:image" content="{{app()->make("url")->to('/')}}/uploads/large/{{@$image}}" />
@else
    <meta property="og:image" content="{{app()->make("url")->to('/')}}/uploads/large/{{conf('logo')}}" />
@endif
<meta property="fb:app_id" content="2417803741600196" />
<link rel="icon" href="{{app()->make("url")->to('/')}}/favicon.ico">


