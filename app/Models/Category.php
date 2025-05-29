<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Category extends Model
{
    protected $guarded = [];
    public function subcategory()
    {
        $this->hasMany(Subcategory::class, 'idcategory');
    }
    public function subcategorys()
    {
        $this->belongsTo(Subcategory::class, 'idcategory');
    }
    // ///////////show category form
    public static function Show()

    {
        $category = Category::all();
        return $category; 
        
    }
// //////////////addcategory////////
public static function addCategory($name,$categorytype){
    $category = new self();
    $category->name = $name;
    $category->categorytype = $categorytype;
    $category->save();
    return $category;
    

}

// ///////view category/////////
public static function viewCategory(){
    $category = Category::all();
    return $category;
}
// /////////edit category////////
public static function editCategory($id){
    $category = Category::findOrFail($id);
    $category->id = $id;
    return $category;
}
// //////////////update category///
public static function updateCat($id,$data){
    $category = self::findOrFail($id);
    $category->update($data);
    // return $category;
}
public static function Deletes($id){
$category = Self::find($id);
return $category;
}
    // ////////////////////////
    public static function Category($request)

    {
        $category = new Category();
        $category->name = $request->name;
        $category->categorytype = $request->categorytype;
        $category->save();

        if ($category) {
            return ['status' => true, 'message' => 'Operation Successfull'];
        } else {
            return ['status' => false, 'message' => 'Operation not Successfull'];
        }
    }
    // ///////////Delete Category

    public static function getAllCategories()
    {
        return self::all();

    }
}
