@extends('layouts.master')

@section('title', 'Produtos')

@section('sidebar')
    @parent
@endsection

@section('content')
    <h1>Products</h1>

    <a href="{{ route('products.create') }}" class="btn btn-default">New Product</a>

    <br><br>
    <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
                <th></th>
                <th></th>
            </tr>

            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ str_limit($product->description, $limit = 100, $end = '...') }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td><a href="{{ route('products.edit', ['id' => $product->id ]) }}"> Edit </a></td>
                    <td><a href="{{ route('products.images', ['id' => $product->id ]) }}"> Images </a></td>
                    <td><a href="{{ route('products.destroy', ['id' => $product->id ]) }}"> Remove </a></td>
                </tr>
            @endforeach
        </table>

        {!! $products->render()!!}
@endsection
