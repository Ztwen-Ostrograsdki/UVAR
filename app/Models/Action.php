<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'author'; 'total'];

    public function author()
    {
    	return $this->belongsTo(Member::class);
    }





}
