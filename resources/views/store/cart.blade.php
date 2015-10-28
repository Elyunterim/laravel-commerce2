@extends('store.store')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image col-sx-1 col-sm-1 col-md-1">Iten</td>
                        <td class="description col-sx-3 col-sm-3 col-md-3">Descrição</td>
                        <td class="price col-sx-2 col-sm-2 col-md-2 text-left">Valor</td>
                        <td class="qty col-sx-2 col-sm-2 col-md-2 text-center">Qtde</td>
                        <td class="col-sx-1 col-sm-1 col-md-1">&nbsp;</td>
                        <td class="total col-sx-2 col-sm-2 col-md-2 text-left">Total</td>
                        <td class="col-sx-1 col-sm-1 col-md-1">&nbsp;</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cart->all() as $key => $item)

                        <tr>
                            <td class="cart_product">
                                <a href="{{ route('store.product', ['id' => $key]) }}">
                                </a>
                            </td>

                            <td class="cart_description">
                                <h4><a href="{{ route('store.product', ['id' => $key]) }}">{{ $item['name'] }}</a></h4>

                                <p>Código: {{ $key }}</p>
                            </td>
                            <td class="cart_total_price text-left">
                                R$ {{ number_format($item['price'], 2, ',', '.') }}
                            </td>
                            <td class="cart_quantity">
                                <div class="form-group">
                                        <div class="input-group" style="width: 110px">
                                                <a href="{{ route('cart.update', ['id' => $key, 'qtd' => ($item['qtd'] - 1)])}}" class="input-group-addon btn btn-default">-</a>
                                                {!! Form::text('', $item['qtd'], [
                                                'class' => 'cart_quantity_input form-control',
                                                'data-id' => $key,
                                                'data-uri' => route('cart.update', ['id' => $key]),
                                                'style' => 'text-align: center'
                                                ]) !!}
                                                <a href="{{ route('cart.update', ['id' => $key, 'qtd' => ($item['qtd'] + 1)])}}" class="input-group-addon btn btn-default">+</a>
                                        </div>
                                </div>
                            </td>
                            <td>&nbsp;</td>
                            <td class="cart_total_price text-left">
                                R$ {{ number_format($item['price'] * $item['qtd'], 2, ',', '.') }}
                            </td>
                            <td>
                                <a href="{{ route('cart.destroy', ['id' => $key]) }}" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <h4><p>Nenhum item foi adicionado no carrinho!</p></h4>
                            </td>
                        </tr>
                    @endforelse
                    <tr class="cart_menu">
                        <td colspan="7">
                            <div class="pull-right">
                                <span style="margin-right: 60px;">TOTAL: R$ {{ number_format($cart->getTotal(), 2, ',', '.') }}</span>

                                @if(count($cart->all() > 0))
                                    <a class="btn btn-success" href="{{route('checkout.place')}}">Finalizar a compra</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@stop