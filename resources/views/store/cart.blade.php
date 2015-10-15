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
                            <td>
                                <h4><a href="{{ route('store.product', ['id' => $key]) }}">{{ $item['name'] }}</a></h4>

                                <p>Código: {{ $key }}</p>
                            </td>
                            <td class="cart_total_price text-left">
                                R$ {{ number_format($item['price'], 2, ',', '.') }}
                            </td>
                            <td>
                                <div class="input-group">
                                    <input data-id="{{ $key }}" name="qtd-{{ $key }}" type="text"
                                           class="pull-right spin" value="{{ $item['qtd'] }}">
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
                                <a href="#" class="btn btn-success">Finalizar a compra</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script>
        $('.spin').TouchSpin({
            min: 1,
            max: 1000,
            postfix: '<span class="glyphicon glyphicon-refresh"></span>',
            postfix_extraclass: "btn btn-default"
        });

        $(".bootstrap-touchspin-postfix").on('click', function () {
            var id = $(this).closest('.input-group').find('input[type="text"]').attr('data-id');
            var qtd = $(this).closest('.input-group').find('input[type="text"]').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('cart.change') }}",
                data: {_token: "{{csrf_token() }}", id: id, qtd: qtd},
                success: function (data) {
                    if (data.status == 'success') {
                        document.location.reload();
                    } else {
                        console.log(data);
                    }
                }
            });
        }).attr('title', 'Atualizar carrinho');
    </script>
@stop