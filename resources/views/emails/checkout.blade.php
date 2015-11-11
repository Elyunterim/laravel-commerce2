<div style="font-family:Arial, Helvetica; font-size: 13px; color: #000000;">
        Olá {{ $user->name }}!<br>
        seu pedido #{{ $order->id }} foi finalizado com sucesso.<br>
        Total do pedido: {{ number_format($order->total, 2, ',', '.') }}<br>
        Atual status do seu pedido: {{ $order->text_status }}<br><br>
        Itens no seu pedido:
        @foreach($order->items as $item)
                <br>{{ $item->product->name }} - {{ $item->qtd }}x{{ number_format($item->price, 2, ',', '.') }} - {{ number_format($item->qtd * $item->price, 2, ',', '.') }}
            @endforeach
    </div>
<br>
<div style="font-family:Arial, Helvetica; font-size: 10px; color: #000000;">
        Para melhor visualizar este email, use o modo de exibição HTML.<br />
        Este email contém informações confidenciais e importantes. Caso não tenha conhecimento dessas informações, por favor delete-o.
    </div>