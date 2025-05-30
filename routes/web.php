<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Spatie\RolePermissionController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

// Route::delete('/prodelete/{id}', [ProductController::class, 'destroy'])->name('admin.delete');
// Route::delete('delete/{id}', [ProductController::class, 'Delete']);
// Route::get('addregister', [AdminController::class, 'register']);
// Route::post('insertregister', [AdminController::class, 'insertregister']);
// Route::get('addlogin', [AdminController::class, 'addlogin']);
// Route::get('/afterregister', [AdminController::class, 'Afterregister'])->name('register');



/////////// Everyone have access below routes************** 
///////////////////////////////////////////////
// Route::get('/login', [HomeController::class, 'Login']);
Route::middleware(['is_user'])->group(function () {

    Route::get('/', [UserController::class, 'Home'])->name('home');
    ////////// default dashbaord ,register or login show 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('rhome');
    ///////////Dashborad route
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('product.view');
    ///////////// Only Admin have acces below routes********
    //////////////////////////////////////
    // Route::middleware('is_admin')->group(function () {
    Route::middleware(['is_admin'])->group(function () {
        // show category/////////////
        Route::get('category', [CategoryController::class, 'Show'])->name('category.formshow');
        // INSERT route of category///////
        Route::post('addcategory', [CategoryController::class, 'Category'])->name('category.add');
        // VIEW Category route///////////
        Route::get('viewcategory', [CategoryController::class, 'ViewCategory'])->name('admin.viewcategory');
        // /// Edit category route/////////////////
        Route::get('edit/{id}', [CategoryController::class, 'Edit'])->name('category.edit');
        // Delete Category route////////
        Route::delete('delete/{id}', [CategoryController::class, 'Delete'])->name('category.delete');
        // Update Category route////////
        Route::post('/update', [CategoryController::class, 'Update'])->name('category.update');
        // Show subcategory form//////////////
        Route::get('/subcategory', [SubcategoryController::class, 'show'])->name('subcategory.formshow');
        // Insert subcategory ////////////
        Route::post('/addsubcategory', [SubcategoryController::class, 'Subcategory'])->name('subcategory.add');
        // Edit subcategory /////////////
        Route::get('/editsubcategory/{id}', [SubcategoryController::class, 'Editsubcategory'])->name('subcategory.edit');
        // Show subcategory ////////////
        Route::get('/viewsubcategory', [SubcategoryController::class, 'Viewsubcategory'])->name('admin.viewsubcategory');
        // Update subcategory ////////////////
        Route::post('/subupdate', [SubcategoryController::class, 'Update'])->name('subcategory.update');
        // Delete subcategory///////////
        Route::delete('subdelete/{id}', [SubcategoryController::class, 'Delete'])->name('subcategory.delete');
        // Product show form ////////////////////////
        Route::get('product', [ProductController::class, 'Show']);
        // Insert product ///////////
        Route::post('addproduct', [ProductController::class, 'Product'])->name('product.add');
        // //on the behalf of categoryid fech subcategory value
        Route::get('/subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
        // //////////Product delete route
        Route::delete('prodelete/{id}', [ProductController::class, 'Delete'])->name('admin.delete');
        /////////Edit product route
        Route::get('editproduct/{id}', [ProductController::class, 'Editproduct'])->name('admin.edit');
        // Update product ///////////////

        Route::post('/proiiiupdate', [ProductController::class, 'ProductUpdate'])->name('product.update');
        // ////show form blog///////////////////
        Route::get('/blog', [BlogController::class, 'Show'])->name('blog');
        /////// Add blog ///////////////////
        Route::post('/addblog', [BlogController::class, 'store'])->name('blog.addblog');
        ///////// get subcategory against categoryid////////
        Route::get('/subcategories/{category_id}', [BlogController::class, 'getSubcategories']);
        // view blog //////////////////
        Route::get('/viewblog', [BlogController::class, 'index'])->name('viewblog');
        // ///// edit blog    ///////////////////
        Route::get('editblog/{id}', [BlogController::class, 'EditBlog'])->name('edit');
        //////// update blog/////////////////
        Route::post('/blogupdate', [BlogController::class, 'BlogUpdate'])->name('update');
        //////// detail page for both product/blog/////////////////
        Route::get('/showblog/{id}', [BlogController::class, 'Multishow'])->name('blog.multi');
        Route::get('/showproduct/{id}', [ProductController::class, 'Multishow'])->name('product.multi');
        /////////////// delete blog///////////
        Route::delete('blogdelete/{id}', [BlogController::class, 'Delete'])->name('blog.delete');
    });
});

// ////////////////////////Role///////////////////////////////////////
Route::get('/show', [RolePermissionController::class, 'Show'])->name('admin.show');
Route::get('/viewRole', [RolePermissionController::class, 'viewRole'])->name('admin.index');
// ///////////////////////Add Role has Permission////////////////////////
Route::post('/store', [RolePermissionController::class, 'Store'])->name('admin.store');
// ////////////////////////Permission/////////////////////////////////
Route::get('/showform', [RolePermissionController::class, 'ShowPermission']);
Route::get('/viewpermission', [RolePermissionController::class, 'viewPermission'])->name('admin.viewpermission');
Route::post('/p_store', [RolePermissionController::class, 'StorePermission'])->name('admin.storepermission');

///////////////////////////Show Model has Role form//////////////////////////////////////
Route::get('/usershow', [UserController::class, 'userShow'])->name('user.show');
///////////////////////////Add Model has Role //////////////////////////////////////
Route::post('/add', [UserController::class, 'Store'])->name('user.add');
// ///////////////////////Show Model has Permissions form//////////////////
Route::get('/model_has_permission', [UserController::class, 'modelHasPermission'])->name('user.model_has_permission');
// ///////////////////////Add Model has Permissions//////////////////
Route::post('/addmodel_has_permission', [UserController::class, 'storePermission'])->name('user.addmodel_has_permission');
////////////////////////////////////////////////////////////////////
Route::get('/userview', [UserController::class, 'viewUsers'])->name('user.viewUser');

// //////Direct permission asigned to user specific/////////////////////////////////////////////////////////
Route::get('/asign-permission-to-user', function () {
    $user = User::find(2);
    $permission = Permission::findByName('writer article');
    $user->givePermissionTo($permission);
    // $role = Role::findByName('writer');
    // $user->assignRole(($role));
    dd('permission asigned');
});
Auth::routes();
