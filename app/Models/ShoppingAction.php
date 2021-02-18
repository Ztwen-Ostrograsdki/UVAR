<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingAction extends Model
{
    use HasFactory;

    protected $fillable = ['action_id', 'member_id', 'total'];



    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
