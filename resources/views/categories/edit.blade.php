@extends('layouts.master')

@section('title', 'Produtos')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="container">
        @if ($errors->any())
            <ul class="alert bg-info">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1>Editing Category: {{ $category->name }}</h1>

        {!! Form::open(['route' => ['categories.update', $category->id, 'method' => 'post' ]]) !!}

        <!-- Name input form -->
        <div class="form-group">
            {!! Form::label('name', 'Name:')!!}
            {!! Form::text('name', $category->name,['class' => 'form-control']) !!}
        </div>

        <!-- Description input form -->
        <div class="form-group">
            {!! Form::label('description', 'Description:')!!}
            {!! Form::textarea('description', $category->description,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save Category',['class'=>'btn btn-primary']) !!}
        </div>

@endsection
