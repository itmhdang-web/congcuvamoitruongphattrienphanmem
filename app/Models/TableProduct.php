<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableProduct extends Model {
    use HasFactory;
    use SoftDeletes;

    protected $table = 'table_product';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
