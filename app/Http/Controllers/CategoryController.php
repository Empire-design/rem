<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // ////show form
    public function showForm()
    {
        return view('admin.Category.addcategory');
    }

    // add category ////////////////////
    public function addCategory(Request $request)
    {
        $category = Category::addCategory($request->name, $request->categorytype);
        return response()->json([
            'status' => true,
            'category' => $category
        ]);
    }
    // view category///////////////////
    public function viewCat()
    {
        $user = Category::viewCategory();
        // return view('admin.Category.viewcategory', compact('user'));
        return response()->json([
            'status' => true,
            'user' => $user
        ]);
    }
    // edit category///////
    public function editCategory($id)
    {
        $categories = Category::editCategory($id);
        //  view('admin.Category.edit', compact('categories'));
          return response()->json([
            'status' => true,
            'user' => $categories
        ]);
    }
    // update category/////////////////
    public function updateCategory(Request $request, $id)
    {
        $data = $request->only(['name', 'categorytype']);
        $category = Category::updateCat($id, $data);
        return response()->json([
            'status' => true,
            'category' => $category
        ]);
    }

    public function Deletes($id)
    {
        $category = Category::Deletes($id);
        // dd($category);
        $category->delete();
        return response()->json([
            'status' => true,
            'category' => $category
        ]);
    }

    public function Show(Request $request)
    {

        $category = Category::all();
        if ($request->expectsJson()) {
            return response()->json($category);
        } else {
        }
        return view('admin.Category.addcategory');
    }

    // Added category ////////////////////

    public function Category(Request $request)
    {
        // dd($request->all());
        $response = Category::Category($request);

        if (($response['status'])) {
            return redirect()->route('admin.viewcategory')->with('success', 'Category successfully inserted');
        } else {
            return redirect()->back()->with('error', 'Category has not inserted');
        }
        // return response()->json(1);
    }

    // View subcategory ////////////////////

    // public function ViewCategory()
    // {
    //     $user = Category::all();
    //     // $user = Category::whereColumn('categorytype','product')->get();
    //     return view('admin.Category.viewcategory', compact('user'));
    // }
    // app/Http/Controllers/Web/CategoryController.php

    public function ViewCategory()
    {
        $user = Category::getAllCategories();
        return view('admin.Category.viewcategory', compact('user'));
    }

    // Edit subcategory ////////////////////

    public function Edit(string $id)
    {
        $categories = Category::find($id);
        // dd($categories);
        return view('admin.Category.edit', compact('categories'));
    }

    // Update category ////////////////////

    public function Update(Request $request)
    {
        $category = Category::find($request->id);
        if (!$category) {
            // dd($request->all());
            return redirect()->back()->with('error', 'Category not found');
        }

        $category->name = $request->name;
        $category->categorytype = $request->categorytype;
        $category->save();

        if ($category) {
            return response()->json(["result" => "Successfully updated"]);
        } else {
            return redirect()->back()->with('error', ' not updated');
        }
    }
    // Delete subcategory ////////////////////

    public function Delete($id)
    {
        // dd($id);
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return response()->json(['result', 'successfully deleted']);
            // return redirect()->back()->with('success', 'Successfully deleted');
        } else {
            return response()->json(['error', 'not  deleted']);

            // return session()->flash('error', 'Category not deleted successfully');
        }
    }
    // ////////////////////////////////////////////////////////

    public function Categoryfetch()
    {
        $category = Category::all();
        return view('admin.Category.viewcategory');
    }
    // ............................///////////////////////

    // public function addCategory(Request $request)
    // {
    //     $category = Category::create([
    //         "name" => $request->name,
    //         "categorytype" => $request->categorytype,
    //     ]);
    //      return response()->json($category, 201); 
    // }
}
