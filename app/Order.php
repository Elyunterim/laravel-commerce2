<?php

namespace LaravelCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
      'user_id',
        'total',
        'status',
        'payment_transaction_reference',
        'payment_transaction_code'
    ];

    public function items()
    {
        return $this->hasMany('LaravelCommerce\OrderItem');
    }

    public function user()
    {
        return $this->belongsTo('LaravelCommerce\User');
    }

    public function getTextStatusAttribute()
    {
        return $this->getStatus()[$this->status];
    }

    public function getStatus()
    {

        $status = [
            0 => "Aguardando o pagamento",
            1 => "Pagamento realizado",
            2 => "Enviado",
            3 => "Entregue",
            4 => "Cancelado"
        ];

        return $status;
    }

}
