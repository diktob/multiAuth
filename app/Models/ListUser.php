<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListUser extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'role'
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
