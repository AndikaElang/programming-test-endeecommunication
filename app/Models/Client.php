<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_client';

    protected $fillable = [
        'client_name',
        'client_address',
        'contract_start_date',
        'contract_end_date',
    ];

    protected $table = 'clients';

    public $timestamps = false;
}
