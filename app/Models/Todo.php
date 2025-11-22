<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];

}
