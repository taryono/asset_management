@if(Models\Slider::whereHas('post_status', function($q){
    $q->where('code', 'publish');
})->where('status', '1')->count() > 0)
<div id="carouselExampleDark2" class="carousel slide" data-bs-ride="carousel">     
    <div class="carousel-inner">
        @foreach(Models\Slider::whereHas('post_status', function($q){
            $q->where('code', 'publish');
        })->get() as $slider)
        <div class="carousel-item {{$slider->status?"active":null}}" data-bs-interval="{{$slider->interval}}">
            <img src="{{assets('sliders/' . $slider->image) }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>{{$slider->title}}</h5>
                <p>{{$slider->text}}</p>
            </div>
        </div>
         @endforeach
    </div>
    <!-- Left right -->
    <a class="carousel-control-prev" data-bs-target="#carouselExampleDark2" data-bs-slide="prev" role="button">
     <i class="fa fa-2x fa-angle-left"></i>
    </a>
    <a class="carousel-control-next" data-bs-target="#carouselExampleDark2" data-bs-slide="next" role="button">
       <i class="fa fa-2x fa-angle-right"></i>
         
    </a>
    <!-- Thumbnails -->
    <ol class="carousel-indicators list-inline">
        @foreach(Models\Slider::whereHas('post_status', function($q){
            $q->where('code', 'publish');
        })->get() as $key => $slider)
        <li class="list-inline-item active" aria-current="true" aria-label="{{$slider->title}}"> 
            <a id="carousel-selector-{{$key}}" class="selected" data-bs-slide-to="{{$key}}" data-bs-target="#carouselExampleDark2"> 
                <img src="{{assets('sliders/' . $slider->image) }}" class="img-fluid"> 
            </a> 
        </li> 
        @endforeach
    </ol>
</div>
@endif