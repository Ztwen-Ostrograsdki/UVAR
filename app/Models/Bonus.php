<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    public function beneficier()
    {
    	return $this->belongsTo(Member::class);
    }
}
