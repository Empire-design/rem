<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    public function categorys()
    {
        return $this->belongsTo(category::class, 'idcategory');
    }
    public function subcategorys()
    {
        return $this->belongsTo(subcategory::class, 'idsubcategory');
    }
    public function image()
    {
        return $this->morphOne(image::class, 'imageable');
    }
    public static function BLog()
    {
        $blog = Blog::all();
        return $blog;
    }

    // 
    public static function addBlog($idcategory, $idsubcategory, $name, $price, $image, $description)
    {
        $blog = new self();
        $blog->idcategory = $idcategory;
        $blog->idsubcategory = $idsubcategory;
        $blog->name = $name;
        $blog->price = $price;
        $blog->image = $image;
        $blog->description = $description;
        $blog->save();
        return $blog;
    }
    // ///////////////////////
    public static function viewBlog()
    {
        $blog = Blog::all();
        return response()->json(['status' => 'success', 'blog' => $blog]);
        // $blog;
    }
    // ////////////////////
    public static function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->id = $id;
        return $blog;
    }
    // ////////////////////
    public static function updateBlog($id, $data)
    {
        $blog = Blog::find($id);
        $blog->update($data);
        return $blog;
    }

    // /////////////////
    public static function Deletes($id)
    {
        $blog = Blog::find($id);
        return $blog;
    }
}
