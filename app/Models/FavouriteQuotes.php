<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteQuotes extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quote_id'];
}
