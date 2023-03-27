@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center mb-4">
        <div class="col">
            <h1>Tutti i progetti</h1>

            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Aggiungi progetto</a>
        </div>
    </div>
    <div class="row">
      <div class="col">  
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Titolo</th>
              <th scope="col">Slug</th>
              <th scope="col">Azioni</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
              <th scope="row">{{ $post->id }}</th>
              <td>{{ $post->title }}</td>
              <td>{{ $post->slug }}</td>
              <td>
              <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-info">Dettagli</a>
              <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning">Modifica</a>

              <form class="d-inline-block"
                action="{{ route('admin.posts.destroy', $post->id) }}" 
                method="POST"
                onsubmit="return confirm('Sei sicuro di voler eliminare questo progetto?');">
                @csrf
              
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Elimina</button>
              </form>

            </td>
            </tr>
            @endforeach
          </tbody>
        </table>
       
        
        
      </div>
  </div>
</div>
@endsection