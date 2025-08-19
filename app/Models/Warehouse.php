<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    protected $guarded = ['id'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'w_product_id', 'id');
    }
}
