<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guared = [];

     //dinh nghia cac mqh product->brand
     public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    //dinh nghia cac mqh product->productCategory

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }

    // product -> productimage
    public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    //product-> productDetails
    public function productDetails(){
        return $this->hasMany(ProductDetail::class,'product_id','id');
    }

    //product->productComment
    public function productComments() {
        return $this->hasMany(ProductComment::class,'product_id','id');
    }

    //product -> orderDetail
    public function orderDetails() {
        return $this->hasMany(OrderDetail::class,'product_id','id');
    }
}
