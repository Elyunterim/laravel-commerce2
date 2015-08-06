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

            <h1>Create Products</h1>

            {!! Form::open(['url'=>'admin/products']) !!}

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

            <!-- Description input form -->
            <div class="form-group">
                {!! Form::label('price', 'Price:')!!}
                {!! Form::text('price', null,['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('featured', 'Featured:&nbsp;') !!}
                {!! Form::radio('featured', 1, false, ['class' => 'field']) !!} Yes
                {!! Form::radio('featured', 0, false, ['class' => 'field']) !!} No
            </div>

            <div class="form-group">
                {!! Form::label('recommend', 'Recommend:&nbsp;') !!}
                {!! Form::radio('recommend', 1, false, ['class' => 'field']) !!} Yes
                {!! Form::radio('recommend', 0, false, ['class' => 'field']) !!} No
            </div>

            <div class="form-group">
                {!! Form::submit('Add Product',['class'=>'btn btn-primary']) !!}
            </div>

@endsection
