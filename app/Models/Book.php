<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $fillable = [
        'code',
        'title',
        'slug', 
        'description',
        'author', 
        'cover',
        'stock'
    ];

    static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = (string) Str::slug($model->title);
        });

        static::updating(function ($model) {
            $model->slug = (string) Str::slug($model->title);
        });
    }

    public function bookCategories()
    {
        return $this->hasMany(BookCategory::class);
    }

    public function rentItems()
    {
        return $this->hasMany(RentItem::class);
    }

    public function bookRented()
    {
        return $this->rentItems()->whereHas('rent', function ($query) {
            $query->whereNull('actual_return_date');
        });
    }

    public function getRentedAttribute()
    {
        $rented = $this->rentItems()->where('is_lost', false)->whereHas('rent', function ($query) {
            $query->whereNull('actual_return_date');
        })->count();

        return $rented;
    }

    public function getCurrentStockAttribute()
    {
        return $this->stock - $this->rented;
    }

    public function getStockPercentageAttribute()
    {
        $rented = $this->rented;
        $stock = $this->stock;
        $percentage = ($rented / $stock) * 100;
        return 100 - $percentage;
    }
}
