<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use Translatable;

    protected $guarded = [];

    public $translatedAttributes = ['name', 'description'];

    protected $appends = ['image_path', 'profit_percent'];

    public function getImagePathAttribute()
    {
        return asset('uploads/products_image/' . $this->image);
    }

    public function getProfitPercentAttribute()
    {
        $profit =$this->sale_price - $this->purchase_price;
        $profit_percent= $profit *100/$this->purchase_price;
        return number_format($profit_percent,2);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
