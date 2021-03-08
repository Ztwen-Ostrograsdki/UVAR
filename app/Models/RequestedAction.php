<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedAction extends Model
{
    use HasFactory;

    protected $fillable = ['action_id', 'member_id', 'total'];



    public function demander()
    {
        return $this->HasMany(Member::class);
    }
}
