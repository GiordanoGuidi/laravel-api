@if($project->exists)
{{--Se sono in edit--}}
<form class="row" method="POST" action="{{route('admin.projects.update',$project)}}" enctype="multipart/form-data">
    @method('PUT')  
@else
{{--Se sono in create--}}
<form class="row" method="POST" action="{{route('admin.projects.store')}}" enctype="multipart/form-data">
    @endif 
    @csrf
    <div class="col-6">
        <div class="mb-3">
    {{--Title--}}
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @elseif(old('title','')) is-valid @enderror"
        id="title" name="title" value="{{old('title',$project->title)}}" required>
        @error('title')
        <div class="ivalid-feedback">
                {{$message}}
        </div>
        @else
        <div class="form text text-muted">
            Inserisci il titolo del progetto
        </div>
        @enderror
        </div>
    </div>
    {{--Slug--}}
    <div class="col-6">
        <div class="mb-3">
            <label for="slug" class="form-label">slug</label>
            <input type="text" class="form-control"
            id="slug" value="{{Str::slug(old('title',$project->title))}}" disabled>
        </div>
    </div>
    {{--Type--}}
    <div class="col-4">
        <label for="type_id" class="form-label">Type</label>
        <select class="form-select form-select-md  @error('type_id') is-invalid @elseif(old('type_id','')) is-valid @enderror" 
        name="type_id" id="type_id">
            <option value="">Nessuna</option>
            @foreach ($types as $type )
            <option value="{{$type->id}}" @if(old('type_id', $project->type?->id) == $type->id) selected @endif>{{$type->label}}</option>
            @endforeach
        </select>
        @error('type_id')
        <div class="ivalid-feedback">
                {{$message}}
        </div>
        @else
        <div class="form text text-muted">
            Inserisci Tipo del progetto
        </div>
        @enderror
    </div>
    {{--Image--}}
    <div class="col-7">
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @elseif(old('image','')) is-valid @enderror" 
            id="image" name="image" value="{{old('image',$project->image)}}">
            @error('image')
        <div class="invalid-feedback">
                {{$message}}
        </div>
        @else
        <div class="form text text-muted">
            Inserisci un immagine di formato PNG, JPG o JPEG.
        </div>
        @enderror
        </div>
    </div>
    <div class="col-1">
        <div class="mb-3">
        <img src="{{asset( 'storage/' . old('image', 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM='))}}" 
        alt="#" class="img-fluid" id="preview">
        </div>
    </div>
    {{--Technologies--}}
    <div class="col-8 my-3">
        <div class="form-group @error('technologies') is-invalid @enderror">
            <p class="form-label">Seleziona tecnologia utilizzate</p>
            @foreach ($technologies as $technology)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="technologies[]"
                     id="technology-{{$technology->id}}" 
                     @if(in_array($technology->id, old('technologies',$prev_technologies ?? [] ))) checked @endif
                     value="{{$technology->id}}">
                    <label class="form-check-label" for="tachnologies[]">{{$technology->label}}</label>
                </div>
            @endforeach
        </div>
        @error('technologies')
        <div class="invalid-feedback">
                {{$message}}
        </div>
        @else
        <div class="form text text-muted">
            Inserisci la Tecnologia
        </div>
        @enderror
    </div>
    {{--Content--}}
    <div class="col-12">
        <div class="form-floating mb-3">
            <label for="content" class="form-label"></label>
            <textarea class="form-control @error('content') is-invalid @elseif(old('content','')) is-valid @enderror" 
            id="content" rows="30" name="content">{{old('content',$project->content)}}</textarea>

            @error('content')
            <div class="ivalid-feedback">
                {{$message}}
            </div>
            @else
            <div class="form text text-muted">
            Il contenuto deve essere di tipo testo.
            </div>
        @enderror
        </div>
    </div>
    <div class="col-12 d-flex justify-content-between">
        <div class="my-5">
            <a href="{{route('admin.projects.index')}}" class="btn btn-primary">
                Torna indietro
            </a>
        </div>
        <div class="d-flex justify-content-center gap-3 my-5">
            <button type="reset" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-rotate-left me-1"></i>Svuota i campi
            </button>
            <button type="submit" class="btn btn-success">
                <i class="fa-regular fa-floppy-disk me-1"></i>Salva
            </button>
        </div>
    </div>
</form>
{{--Scripts--}}
@section('scripts')
<script>
    const inputTitle = document.getElementById('title');
    const inputSlug = document.getElementById('slug');
    inputTitle.addEventListener('blur', () => {
        inputSlug.value = inputTitle.value.trim().toLowerCase().split(' ').join('-');
    })
</script>
@endsection