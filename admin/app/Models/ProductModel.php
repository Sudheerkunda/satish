<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = "y_products";
    public $timestamps = false;
    protected $fillable =[
        'Category_Id','Product_Name','Price','Image','status','Reg_Date','Update_Date'
    ];
}
