<?php

namespace App\Models;

use App\Models\Member;
use App\Models\ShoppingAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'actionnary', 'total'];

    public function author()
    {
    	return $this->belongsTo(Member::class);
    }

    public function totalBought()
    {
    	return array_sum(ShoppingAction::where('action_id', $this->id)->pluck('total')->toArray());
    }


    





}
