<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_client';

    protected $fillable = [
        'id_client',
        'item_name',
        'item_price',
        'date_order',
    ];

    protected $table = 'orders';

    public $timestamps = false;
}
