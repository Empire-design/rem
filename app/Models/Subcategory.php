<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded =[];
    public function categorys()
    {
        return $this->hasMany(Category::class, "idcategory");
    }
    public function category()
    {
        return $this->belongsTo(Category::class, "idcategory");
    }
    public function subcategory(){
        $subcategory = Subcategory::all();
        return $subcategory;
    }
    public static function addSubcategory($idcategory,$subcategoryname){
        $subcategory = new self();
        $subcategory->idcategory = $idcategory;
        $subcategory->subcategoryname = $subcategoryname;
        $subcategory->save();
        return $subcategory;

    }
    public static function viewSubcategory(){
        $subcategory = Subcategory::all();
        return $subcategory;
    }
    public static function editSubcategory($id){
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->id = $id;
        return $subcategory;
    }
    public static function updateSubcategory($id,$data){
        $subcategory = Subcategory::find($id);
        $subcategory->update($data);
        return $subcategory;
    }
    public static function Deletes($id){
        $subcategory = Subcategory::find($id);
        return $subcategory;
    }
}
