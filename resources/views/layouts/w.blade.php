<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('adminlte.title', 'Masjid Mujahidin') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugin_vendor/fontawesome-free/css/all.min.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/tree.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/fe.css') }} ">
    <!-- Styles -->

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-2">
            <a class="navbar-brand" href="#">{{ config('adminlte.title', 'Masjid Mujahidin') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {!! dropdown() !!}
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-end">
                    <form class="d-flex" action="{{route('search.post')}}">
                        <input name="search" class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    @guest 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRight" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Akun
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownRight">
                            
                            @if (Route::has('login'))
                                <li><a class="dropdown-item" href="{{ route('login') }}">Log in</a></li>
                            @endif
                            @if (Route::has('register'))
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            @endif
                            <!--
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            -->
                        </ul>
                    </li>
                    @else  
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRight" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownRight">
                            @if (Route::has('home'))
                                <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                            @endif 
                            @if (Route::has('logout'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endif  
                        </ul>
                    </li>
                        
                    @endif
                </ul>
            </div>
        </nav> 
        <section>
            @include('layouts.slice.carousel')
        </section>
        <section>
            <div class="row">
                <div class="col-lg-9 content">
                    @yield('content')
                </div>
                 @include('layouts.slice.sidebar') 
            </div>
        </section>
        <section>
            @include('layouts.slice.footer') 
        </section>

        <footer>
            <div class="ml-4 text-right text-sm text-white-500 sm:text-right sm:ml-0 mt-20">
                {{-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) --}}
                <sup>Copy<sup>&copy;</sup> Right By Taryono 2022 - {{ date('Y') }}</sup>
            </div> 
        </footer>
        
    </div>
    <script src="{{ asset('plugin_vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/fe.js') }}"> </script>
    <script type="text/javascript">
        //<![CDATA[

        $(function() {
            $(".tree li:has(ul)")
                .addClass("parent_li")
                .find(" > span")
                .attr("title", "Collapse this branch");

            $(document).on("click", ".tree li.parent_li > span", function(e) {

                var children = $(this).parent("li.parent_li").find(" > ul > li"); 
                var p = this;
                var icon = $(this).attr("title", "Collapse this branch").find(" > i");
                let model = $(this).attr('data-model');
                let target = $(this).attr('data-target');
                let id = $(this).attr('data-id');
                let month = $(this).attr('data-month');
                let category = $(this).attr('data-category');
                
                if (children.is(":visible")) { 
                    if (model) {
                        children.remove(); 
                    } 
                } else { 
                    if (target) {
                        $.get('{{ url('/welcome/children') }}',
                            {
                                model:model, 
                                target:target, 
                                month:month,
                                category:category,
                                id:id
                            }, 
                            function(res) {
                                if(id){
                                    $("div.content").html(res);
                                }else{
                                    $(res).insertAfter(p) 
                                }
                            })  
                    } 
                }

                children.hide("fast");   
                if(!$(icon).hasClass("lastchild")){
                    if($(icon).hasClass("fa-minus")){
                        $(icon).removeClass("fa-minus").addClass("fa-plus");
                    }else{
                        children.show("fast");
                        $(icon).addClass("fa-minus").removeClass("fa-plus");
                    }                    
                }
                e.stopPropagation();
            });
        });

        //]]>
    </script>
</body>

</html>
