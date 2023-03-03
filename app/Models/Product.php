<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Size;
use App\Models\Color;
use App\Models\Review;
use App\Models\Category;
use App\Models\Favourite;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function favourite()
    {
        return $this->hasOne(Favourite::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
