<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['reaction_id', 'user_id', 'post_id', 'comment',];
    use HasFactory;
}
