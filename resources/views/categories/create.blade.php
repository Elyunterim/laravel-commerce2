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
        <h1>Create Category</h1>

        {!! Form::open(['url'=>'admin/categories']) !!}

        <!-- Name input form -->
        <div class="form-group">
            {!! Form::label('name', 'Name:')!!}
            {!! Form::text('name', null,['class' => 'form-control']) !!}
        </div>

        <!-- Description input form -->
        <div class="form-group">
            {!! Form::label('description', 'Description:')!!}
            {!! Form::textarea('description', null,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add Category',['class'=>'btn btn-primary']) !!}
        </div>

@endsection
