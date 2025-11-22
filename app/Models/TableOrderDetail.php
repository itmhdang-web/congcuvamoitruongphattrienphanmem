<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOrderDetail extends Model {
    use HasFactory;

    protected $table = 'table_order_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function foreignKey_products() {
        return $this->hasMany(related: TableProduct::class, foreignKey: 'id_product', localKey: 'id');
    }

}
