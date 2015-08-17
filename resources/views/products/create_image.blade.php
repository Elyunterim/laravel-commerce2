@extends('layouts.master')

@section('title', 'Produtos')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">

            <h1>Upload Image</h1>

            {!! Form::open(['route' => ['products.images.store', $product->id], 'method'=>'post', 'enctype'=>"multipart/form-data"]) !!}

            @if ($errors->any())
                           <ul class="alert bg-info">
                               @foreach($errors->all() as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                            </ul>
                        @endif

            <!-- Name input form -->
            <div class="form-group">
                {!! Form::label('image', 'Image:')!!}
                {!! Form::file('image', null,['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Upload Image',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

@endsection
