@extends('layouts.master')

@section('title', 'Produtos')

@section('sidebar')
    @parent
@endsection

@section('content')
    <h1>Categories</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-default">New Category</a>

    <br><br>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Description</th>
            <th>Action</th>
            <th></th>
        </tr>

        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td><a href="{{ route('categories.edit', ['id' => $category->id ]) }}"> Edit </a></td>
                <td><a href="{{ route('categories.destroy', ['id' => $category->id ]) }}"> Remove </a></td>
            </tr>
        @endforeach

    </table>

@endsection

