<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class domains extends Model
{
    use HasFactory;
    protected $fillable = [
        'domain',
        'fetched_id',
        'user_uid',
        'created_at'
    ];
}
