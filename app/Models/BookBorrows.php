<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookBorrows extends Model
{
    protected $fillable = [
        "bookid",
        "userid",
        "borrowdate",
        "returndate"
    ];

    public function book() {
        return $this->belongsTo(Books::class,"bookid","bookid");
    }
    
    public function user() {
        return $this->belongsTo(User::class,"userid","id");
    }

    protected function casts(): array
    {
        return [
            'borrowdate' => 'datetime',
            'returndate' => 'datetime'
        ];
    }
}
