@extends('layouts.app')

@section('title','Project')

@section('content')
    <section id="guest-show" class="my-5">
        <h1 class="mb-5">{{$project->title}}</h1>
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
                            <p>Nessuna</p>
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
            <a href="{{route('guest.home')}}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Torna indietro</a>
        </footer>
    </section>
@endsection
