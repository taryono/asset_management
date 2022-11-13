<?php
    $sliders = \Models\Slider::whereNotNull('image')->limit(3)->get();           
    $name = "carouselExampleDark2";
?>
<div id="{{$name}}" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner"> 
        @if($sliders->count() > 0)
            @foreach($sliders as $i=> $slide)
                @if($slide->image !=null && file_exists(storage_path('app/public/sliders/'.$slide->image)))
                    <div class="carousel-item {{$i==0?'active':''}}" data-bs-interval="{{$slide->interval}}">
                        <img src="{{ asset('sliders/'.$slide->image) }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{$slide->title}}</h5>
                            <p>{{$slide->text}}</p>
                        </div>
                    </div> 
                @endif
            @endforeach
        @else  
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="{{ asset('assets/images/background/masjid.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ asset('assets/images/background/dark-flower.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/background/slider.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        @endif
    </div>
    <!-- Left right -->
    <a class="carousel-control-prev" data-bs-target="#{{$name}}" data-bs-slide="prev" role="button">
     <i class="fa fa-2x fa-angle-left"></i>
    </a>
    <a class="carousel-control-next" data-bs-target="#{{$name}}" data-bs-slide="next" role="button">
       <i class="fa fa-2x fa-angle-right"></i>
         
    </a>
    <!-- Thumbnails -->
    <ol class="carousel-indicators list-inline">
        @if($sliders->count() > 0)
            @foreach($sliders as $i => $slide)
                @if($slide->image !=null && file_exists(storage_path('app/public/sliders/'.$slide->image)))
                    <li class="list-inline-item {{$i==0?'active':''}}" aria-current="true" aria-label="{{$slide->title}}"> 
                        <a id="carousel-selector-{{$i}}" class="selected" data-bs-slide-to="{{$i}}" data-bs-target="#{{$name}}"> 
                            <img src="{{ asset('sliders/'.$slide->image) }}" class="img-fluid"> 
                        </a> 
                    </li>
                @endif
            @endforeach
        @else 
        <li class="list-inline-item active" aria-current="true" aria-label="Slide 0"> 
            <a id="carousel-selector-0" class="selected" data-bs-slide-to="0" data-bs-target="#{{$name}}"> 
                <img src="https://i.imgur.com/weXVL8M.jpg" class="img-fluid"> 
            </a> 
        </li>
        <li class="list-inline-item" aria-label="Slide 1"> 
            <a id="carousel-selector-1" data-bs-slide-to="1" data-bs-target="#{{$name}}"> 
                <img src="https://i.imgur.com/Rpxx6wU.jpg" class="img-fluid"> 
            </a> 
        </li>
        <li class="list-inline-item" aria-label="Slide 2"> 
            <a id="carousel-selector-2" data-bs-slide-to="2" data-bs-target="#{{$name}}"> 
                <img src="https://i.imgur.com/83fandJ.jpg" class="img-fluid"> 
            </a> 
        </li>
        @endif
    </ol>
</div>