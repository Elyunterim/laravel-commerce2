@extends('admin.app')

@section('content')
        <div class="container">
                <h1>Pedido #{{ $order->id }}</h1>
                <br>
                <p><strong>Nome:</strong> {{ $order->user->id }} - {{ $order->user->name }}</p>
                <p><strong>Endereço:</strong> {{ $order->user->street_one }} @if(isset($order->user->street_two)) - {{ $order->user->street_two }}@endif</p>
                <p><strong>Cidade:</strong> {{ $order->user->city }} / {{ $order->user->state }}</p>
                <p><strong>CEP:</strong> {{ $order->user->postal_code }}</p>
                <p><strong>Telefone:</strong> {{ $order->user->phone }}</p>

                <h3>Itens no pedido</h3>
                <table class="table table-striped">
                        <thead>
                            <tr>
                                    <th>Produto</th>
                                    <th class="text-center">Qtde</th>
                                    <th class="text-center">Valor Unitário</th>
                                    <th class="text-center">Total</th>
                                </tr>
                        </thead>
                        <tbody>
                        @foreach($order->items as $item)
                                <tr>
                                        <td>{{ $item->product->id }} - {{ $item->product->name }}</td>
                                        <td class="text-center">{{ $item->qtd }}</td>
                                        <td class="text-center">{{ number_format($item->price, 2, ",", ".") }}</td>
                                        <td class="text-center">{{ number_format($item->qtd * $item->price, 2, ",", ".") }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                    <td colspan="3"></td>
                                    <td class="text-center"><strong>{{ number_format($order->total, 2, ",", ".") }}</strong></td>
                                </tr>
                        </tfoot>
                    </table>

                <h3>Status do pedido</h3>
                <p>{{ $order->text_status }}</p>

                <br/><br/>
                <a class="btn btn-default" href="{{ route('admin.orders') }}">Voltar para lista</a>
            </div>
    @endsection