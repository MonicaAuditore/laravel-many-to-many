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
            <h1>{{ $technology->name }}</h1>
            <h6>{{ $technology->slug }}</h6>
            <h3>Articoli associati {{ $technology->posts()->count() }}</h3>

            @if ($technology->posts()->count() > 0)
            <ul>
                @foreach ($technology->posts as $post)
                <li>
                    <a href="{{ route('admin.technologies.show', $post->id) }}">{{ $post->title }}</a>
                </li>
                @endforeach
            </ul>
            @else 
            <h3>
                Nessun progetto associato
            </h3>
            @endif

        </div>
    </div>
</div>
@endsection