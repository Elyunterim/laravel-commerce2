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

            <h1>Editing Products: {{ $product->name }}</h1>

            {!! Form::open(['route' => ['products.update', $product->id, 'method' => 'post' ]]) !!}

            <!-- Name input form -->
            <div class="form-group">
                {!! Form::label('category', 'Category:')!!}
                {!! Form::select('category_id', $categories, $product->category_id,['class' => 'form-control']) !!}
            </div>

            <!-- Name input form -->
            <div class="form-group">
                {!! Form::label('name', 'Name:')!!}
                {!! Form::text('name', $product->name,['class' => 'form-control']) !!}
            </div>

            <!-- Description input form -->
            <div class="form-group">
                {!! Form::label('description', 'Description:')!!}
                {!! Form::textarea('description', $product->description,['class' => 'form-control']) !!}
            </div>

            <!-- Description input form -->
            <div class="form-group">
                {!! Form::label('price', 'Price:')!!}
                {!! Form::text('price', $product->price,['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('featured', 'Featured:&nbsp;') !!}
                {!! Form::radio('featured', 1, ($product->featured)? true : false, ['class' => 'field']) !!} Yes
                {!! Form::radio('featured', 0, (!$product->featured) ? true : false, ['class' => 'field']) !!} No
            </div>

            <div class="form-group">
                {!! Form::label('recommend', 'Recommend:&nbsp;') !!}
                {!! Form::radio('recommend', 1, ($product->recommend)? true : false, ['class' => 'field']) !!} Yes
                {!! Form::radio('recommend', 0, (!$product->recommend) ? true : false, ['class' => 'field']) !!} No
            </div>

            <div class="form-group">
                {!! Form::label('tags', 'Tags (separate with commas)') !!}
                {!! Form::textarea('tags', $product->tagList, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Example: tag1, tag2, tag3...']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save Product',['class'=>'btn btn-primary']) !!}
            </div>

@endsection
