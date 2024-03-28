@extends('layouts.app')

@section('title','Project Details')

@section('cdns')
{{--Fontawesome--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <h1 class="my-5">{{$project->title}}</h1>

    <div>
        <div class="clearfix">
            @if($project->image)
                <img class="float-start me-5" src="{{asset('storage/' . $project->image)}}" alt="{{$project->title}}">
                @endif
            <p>{{$project->content}}</p>
            <div>
                <p><strong>Tipo:</strong>
                @if($project->type)
                    <span class="badge" style="background-color:{{$project->type->color}}">{{$project->type?->label}}</span>
                @else 
                    <span>Nessuna</span>
                </p>
                @endif
                <p><strong>Tecnologia:</strong>
                @forelse($project->technologies as $technology)
                        <span class="badge rounded-pill text-bg-{{$technology->color}}">{{$technology->label}}</span>
                @empty
                    <span>Nessuna</span>
                    </p>
                @endforelse
                <p><strong>Creato il :</strong>{{$project->created_at}}</p>
                <p><strong>Ultima modifica :</strong>{{$project->updated_at}}</p>
            </div>
        </div>
    </div>

    <footer class="d-flex justify-content-between align-items-center my-5">
        <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Torna indietro</a>

        <div class="d-flex justify-content-between gap-3">
            <a href="{{route('admin.projects.edit',$project)}}" class="btn btn-warning">
                <i class="fa-solid fa-pencil me-1"></i>Modifica</a>

            <form action="{{route('admin.projects.destroy',$project->id)}}" method="POST"
                id="form-delete" data-project="{{$project->title}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" class="btn btn-danger">
                    <i class="fa-solid fa-trash-can me-1"></i>Elimina
                </button>
            </form>
        </div>
    </footer>
@endsection

{{--Scripts--}}
@section('scripts')
    <script>
        const formDelete= document.getElementById('form-delete');
        formDelete.addEventListener('submit', e => {
            e.preventDefault();
            const project = formDelete.dataset.project;
            const confirmation = confirm(`Sei sicuro di voler eliminare il projetto ${project}?`);
            if(confirmation) formDelete.submit();
        })

    </script>

@endsection