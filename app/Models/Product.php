<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function category()
    {
        return $this->hasMany(Category::class, 'idcategory');
    }
    public function subcategory()
    {
        return $this->hasMany(Subcategory::class, 'idsubcategory');
    }
    public function categorys()
    {
        return $this->belongsTo(Category::class, 'idcategory');
    }
    public function subcategorys()
    {
        return $this->belongsTo(Subcategory::class, 'idsubcategory');
    }
    public function image()
    {
        return $this->morphOne(image::class, 'imageable');
    }
    ///////////////////////show form
    public static function Product()
    {
        $product = Product::all();
        return $product;
    }
    public static function addProduct($idcategory, $idsubcategory, $productname, $productimage, $description, $price)
    {
        $product = new self();
        $product->idcategory = $idcategory;
        $product->idsubcategory = $idsubcategory;
        $product->productname = $productname;
        $product->productimage = $productimage;
        $product->price = $price;
        $product->description = $description;
        $product->save();
        return $product;
    }
    public static function viewProduct()
    {
        $product = Product::with(['categorys', 'subcategorys'])->get();
        return $product;
    }
    public static function editProduct($id)
    {
        $product = Product::find($id);
        $product->id = $id;
        return $product;
    }
    public static function updateProduct($id, $data)
    {
        $product = Product::find($id);
        $product->update($data);
        return $product;
    }
    //////////////////
    public static function Deletes($id)
    {
        $product = Self::find($id);
        return $product;
    }
}
