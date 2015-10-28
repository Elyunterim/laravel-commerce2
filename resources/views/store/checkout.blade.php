@extends('store.store')
@section('content')
    <div class="col-sm-12">
        <h3>Pedido realizado com sucesso!</h3>
        <p>O pedido #{{$order->id}} foi realizado com sucesso!</p>
    </div>
@endsection