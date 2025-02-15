<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $fillable = ['name', 'address', 'telp', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
