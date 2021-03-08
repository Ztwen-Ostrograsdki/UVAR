<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['type', 'description', 'amount', 'sender', 'receiver', 'operator', 'operator_id_transaction'];

    public function sender()
    {

    }

    public function receiver()
    {
    	
    }

    
}
