<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'cat_id',
        'title',
        'price',
        'description',
    ];

    protected $appends = [
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'cat_id');
    }

    public function quantityRecord()
    {
        return $this->hasOne(ProductQuantity::class, 'product_id');
    }

    public function getQuantityAttribute()
    {
        return $this->quantityRecord->quantity ?? null;
    }

    public function setQuantity($value)
    {
        return ProductQuantity::FirstOrCreate(['product_id' => $this->id], ['quantity' => intval($value)]);
    }
}
