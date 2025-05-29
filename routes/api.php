<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['auth:api', 'is_admin'])->group(function () {
    Route::get('category', [CategoryController::class, 'Show']);
    Route::post('addcategory', [CategoryController::class, 'Category']);
    Route::get('viewcategory', [CategoryController::class, 'ViewCategory']);
    Route::post('deletess/{id}', [CategoryController::class, 'Delete']);
    Route::post('up', [CategoryController::class, 'Update']);

    //////////form show
    Route::get('/subcategory', [SubcategoryController::class, 'show']);
    // ///////addsubcategory
    Route::post('/addsubcategory', [SubcategoryController::class, 'Subcategory']);
    Route::get('test', fn() => ['name' => 'saif', 'class' => 'bscs']);
    Route::get('testss', [BlogController::class, 'Apifetch']);


    ////////////////////////////////////////////////////Category
    // /////////category form show
    Route::get('/show', [CategoryController::class, 'showForm']);
    // ///////Add category/////////
    Route::post('/addcategory', [CategoryController::class, 'addCategory']);
    // /////View category/////////
    Route::get('/viewcategory', [CategoryController::class, 'viewCat']);
    // ////Edit category//////////
    Route::get('/editcategory/{id}', [CategoryController::class, 'editCategory']);
    // ///update category ////////////
    Route::post('/updatecategory/{id}', [CategoryController::class, 'updateCategory']);
    Route::post('/catdelete/{id}', [CategoryController::class, 'Deletes']);



    // ///////////////////////////////////////////////////////Subcategory
    Route::get('/subshow', [SubcategoryController::class, 'Subcategories']);
    Route::post('/addsubcategory', [SubcategoryController::class, 'addSubcategory']);
    Route::get('/viewsubcategory', [SubcategoryController::class, 'viewSubcategorys']);
    Route::get('/editsub/{id}', [SubcategoryController::class, 'editSubcategorys']);
    Route::post('/updatesubcategory/{id}', [SubcategoryController::class, 'updateSubcategorys']);
    Route::post('/delete/{id}', [SubcategoryController::class, 'subDelete']);



    //////////////////////////////////////////////////////////Product
    Route::get('/proshow', [ProductController::class, 'showProduct']);
    Route::post('/addproduct', [ProductController::class, 'addProduct']);
    Route::get('/subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
    Route::get('/viewpro', [ProductController::class, 'viewProducts']);
    Route::get('/editpro/{id}', [ProductController::class, 'editProducts']);
    Route::post('/updatepro/{id}', [ProductController::class, 'updateProduct']);
    Route::post('/delete/{id}', [SubcategoryController::class, 'productDelete']);



    // ////////////////////////////////////////////////////////Blog
    Route::get('/blog', [BlogController::class, 'Blog']);
    Route::post('/addblog', [BlogController::class, 'addBlog']);
    Route::get('/viewblog', [BlogController::class, 'viewBlog']);
    Route::get('/editblog/{id}', [BlogController::class, 'editBlogs']);
    Route::post('/updateblog/{id}', [BlogController::class, 'updateBlog']);
    Route::post('/blogdelete/{id}', [BlogController::class, 'blogDelete']);
});
