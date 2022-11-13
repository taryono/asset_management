<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$title}}</title> 
    @if(isset($css) && !empty($css))
        @if(is_array($css))
            @foreach($css as $c)
            <link rel="stylesheet" type="text/css" href="{{$c}}"/>
            @endforeach
        @else 
        <link rel="stylesheet" type="text/css" href="{{$css}}"/>
        @endif 
    @endif  
    @include('print.css') 
    @stack('style')
    @yield('style')
</head>
<body> 
    @yield('header')
    @yield('body')
    @yield('footer')
</body>
</html>
