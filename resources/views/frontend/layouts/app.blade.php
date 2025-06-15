<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <title>EduCore - Online Courses & Education HTML Template</title>
@include('frontend.partials.css')
@stack('css_extend')
@include('frontend.partials.js')
@yield('js-init-upload')

</head>

<body class="home_3">


<!--============ PRELOADER START ===========-->
<div id="preloader">
    <div class="preloader_icon">
        <img src="{{asset('assets/images/preloader.png')}}" alt="Preloader" class="img-fluid">
    </div>
</div>
<!--============ PRELOADER START ===========-->


@include('frontend.partials.header')

@yield('content')

<!--================================
        SCROLL BUTTON START
    =================================-->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!--================================
        SCROLL BUTTON END
    =================================-->


@yield('js')
@stack('js_extend')

</body>

</html>
