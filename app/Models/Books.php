<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = [
        "bookname",
        "quantity"
    ];

    public $incrementing = true;

    protected $primaryKey = "bookid";
}
