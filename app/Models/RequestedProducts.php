<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedProducts extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'total'];



    public function demander()
    {
        return $this->belongsToMany(User::class);
    }
}
