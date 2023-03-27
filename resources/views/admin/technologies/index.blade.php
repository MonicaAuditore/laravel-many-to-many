@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center mb-4">
        <div class="col">
            <h1>Tutte le tecnologie</h1>

            <a href="{{ route('admin.technologies.create') }}" class="btn btn-success">Aggiungi tecnologia</a>
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
            @foreach ($technologies as $technology)
            <tr>
              <th scope="row">{{ $technology->id }}</th>
              <td>{{ $technology->title }}</td>
              <td>{{ $technology->slug }}</td>
              <td>
              <a href="{{ route('admin.technologies.show', $technology->id) }}" class="btn btn-info">Dettagli</a>
              <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-warning">Modifica</a>

              <form class="d-inline-block"
                action="{{ route('admin.technologies.destroy', $technology->id) }}" 
                method="POST"
                onsubmit="return confirm('Sei sicuro di voler eliminare questa tecnologia?');">
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