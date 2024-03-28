@extends('layouts.app')

@section('title','Create')

@section('content')
    <section id="create-project" class="my-5">
        <h1 class="mb-5">Nuovo progetto</h1>
        {{--Form--}}
       @include('includes.layouts.form')
    </section>
@endsection
{{--Scripts--}}
@section('scripts')
    <script>
        const placeholder ='https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=';
        const input = document.getElementById('image');
        const preview= document.getElementById('preview');
        input.addEventListener('input', ()=>{
            preview.src = input.value ? input.value : placeholder;
        })
    </script>

@endsection