@extends('app')
@section('content')
    <div class="col-sm-12">
        <h3>Pedidos</h3>

        <table class="table">
            <tbody>
            <tr>
                <th>#ID</th>
                <th>Cliente</th>
                <th>Total do Pedido</th>
                <th>Status</th>
                <th></th>
            </tr>

            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->id }} - {{ $order->user->name }}</td>
                    <td>{{ number_format($order->total, 2, ",", ".") }}</td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default btn-sm dropdown-toggle text-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{ $order->text_status }} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                @foreach($order->getStatus() as $k=>$status)
                                    <li><a href="{{ route('admin.orders.update_status', ['id' => $order->id, 'status' => $k]) }}">{{ $status }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                    <td><a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" class="btn btn-primary btn-sm" title="Ver detalhes do pedido"><i class="glyphicon glyphicon-list-alt"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection