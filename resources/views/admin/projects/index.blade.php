@extends('layouts.app')

@section('title', 'Projects')


@section('content')
{{--Index dei Progetti--}}
<section id="projects-index" class="my-5">
    <h1 class="mb-5">Projects</h1>
    {{--Tabella--}}
    <table class="table table-dark">
        <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Titolo</th>
              <th scope="col">Slug</th>
              <th scope="col">Type</th>
              <th scope="col">Technology</th>
              <th scope="col">Creato il</th>
              <th scope="col">Ultima modifica</th>
              <th scope="col" class="text-end">
                <div class="d-flex gap-2 justidy-content-end">
                    <a href="{{route('admin.projects.create')}}" class="btn btn-success"><i class="fa-solid fa-plus me-1"></i>Nuovo</a>
                    <a href="{{route('admin.projects.trash')}}" class="btn btn-danger"><i class="fa-solid fa-trash-can me-1"></i>Vedi Cestino</a>
                </div>
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            @forelse ($projects as $project )
            <tr>
                <th scope="row">{{$project->id}}</th>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td>
                    @if($project->type)
                        <span class="badge" style="background-color:{{$project->type->color}}">{{$project->type?->label}}</span>
                    @else 
                        <p>Nessuna</p>
                @endif
                </td>
                <td>
                    @forelse($project->technologies as $technology)
                        <span class="badge rounded-pill text-bg-{{$technology->color}}">{{$technology->label}}</span>
                    @empty
                        <p>Nessuna</p>
                @endforelse
                </td>
                <td>{{$project->created_at}}</td>
                <td>{{$project->updated_at}}</td>
                <td>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{route('admin.projects.show',$project)}}" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{route('admin.projects.edit',$project)}}" class="btn btn-warning">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
    
                    <form action="{{route('admin.projects.destroy',$project->id)}}" method="POST" 
                        class="form-delete" data-project="{{$project->title}}">
                        @csrf
                        @method('DELETE')
                        <button  class="btn btn-danger">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <h3>Non ci sono progetti</h3>
                </td>
            </tr>
            @endforelse
          </tbody>
      </table>
      <h3>Progetti per Tipologia</h3>
      <div class="row row-cols-3 g-4 mt-1">
        @foreach ($types as $type)
        <div class="col">
            <h6>{{$type->label }}({{count($type->projects)}}) </h6>
            @forelse($type->projects as $project)
                <a href="{{route('admin.projects.show',$project)}}" class="text-decoration-none">{{$project->title}}</a> <br>
            @empty
                <p>Nussun Progetto</p>
            @endforelse
        </div>
        @endforeach
      </div>
      @if($projects->hasPages())
        {{$projects->links()}}
      @endif
</section>
@endsection

{{--Scripts--}}
@section('scripts')
    <script>
        const formsDelete= document.querySelectorAll('.form-delete');
        formsDelete.forEach(form => {
            form.addEventListener('submit', e => {
                e.preventDefault();
                const project = form.dataset.project;
                const confirmation = confirm(`Sei sicuro di voler eliminare il projetto ${project}?`);
                if(confirmation) form.submit();
            })
        });

    </script>

@endsection