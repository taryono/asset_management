 {{ Form::open(['method' => 'POST', 'route' => ['page.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
     <div class="form-group">
         <label for="name">Nama Halaman</label> 
        {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Judul','required']) }}             
     </div> 
     <div class="form-group">
        <label for="post_id">Content</label>
        {{Form::select('post_id', \Models\Post::whereNotIn('category_id', [4,5])->where('post_status_id', 2)->pluck('title', 'id')->all(), null, ['class' => 'form-control','required'])}}
    </div>
    <div class="form-group">
        <label for="parent_id">Parent</label>
        {!!select_parents()!!} 
    </div>
    <div class="form-group">
        <label for="sequence">Urutan Menu</label>
        {{Form::text('sequence', null, ['class' => 'form-control','required'])}}
    </div> 
    <div class="form-group">
        <label for="type">Tipe Menu</label>
        {{Form::select('type', ['top_left' => 'Top Left', 'top_right' => 'Top Right'], null, ['class' => 'form-control'])}}
    </div>
 </div>
 {{ Form::close() }}
