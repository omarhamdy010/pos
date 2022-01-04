<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function clients()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class , 'product_order')->withPivot('quanities');
    }
}
