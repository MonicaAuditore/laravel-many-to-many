@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="row justify-content-center">
        <div class="col">
            <h1>{{ $post->title }}</h1>
            <h6>{{ $post->slug }}</h6>

            {{-- lancio la funzione category contenuta nel model di post per ottenere il nome della categoria associata a questo post--}}
            

            <h3>{{ $post->category ? $post->category->name : 'Nessuna categoria'}}</h3>

            {{-- dato che si aspetta un'array per la many to many cicliamo sulla risposta della funziopne technologies del model di post --}}
            @foreach ($post->technologies as $tecnology)
            <h3>{{ $tecnology ? $tecnology->name : 'Nessuna categoria'}}</h3>
            @endforeach
           
            

            @if ($post->img)
            <div>
                <img src="{{ asset('storage/'.$post->img) }}" style="height: 250px;" alt="">
            </div>
            @endif

            <p>{{ $post->content }}</p>
        </div>
    </div>
</div>
@endsection