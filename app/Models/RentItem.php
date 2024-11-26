<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentItem extends Model
{
    protected $fillable = [
        'rent_id', 
        'book_id', 
        'is_lost'
    ];

    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
