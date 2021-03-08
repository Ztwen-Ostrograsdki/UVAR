<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;
    protected $fillable = ['beneficier', 'value', 'title'];

    public static function __bonuser()
    {
    	$bonus = 500.00;
    	return $bonus;
    }

    public function beneficier()
    {
    	return $this->belongsTo(Member::class);
    }
}
