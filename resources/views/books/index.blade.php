@extends('layouts.app')

@section('content')

<h1>Biblioteca</h1>

<a href="{{ route('books.create')}}">registrar</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Autor</th>
            <th>Titulo</th>
            <th>Fecha de publicacion</th>
            <th>Botones</th>
        </tr>
    </thead>

    <tbody>
        @forelse($books as $book)

        <tr>
            <td>{{$book->autor-name}}</td>
            <td>{{$book->title}}</td>
            <td>{{$book-publication_date}}</td>

            <td>
                <a href="{{route('books.edit',$book)}}">Editar</a>

                <form action="{{route('books.destroy',$book)}}" method="POST">

                @csrf 
                @method('delete')

                <button type="submit" onclick=" return confirm('¿Eliminar?')">
                    Eliminar
                </button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection