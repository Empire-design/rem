<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    // ////show form
    public function showForm()
    {
        if (Gate::allows('is_admin')) {

            return view('admin.Category.addcategory');
        } else {
            return view('admin.dashboard');
        }
    }

    // add category ////////////////////
    public function addCategory(Request $request)
    {
        if (Gate::allows('is_admin')) {

            $category = Category::addCategory($request->name, $request->categorytype);
            return response()->json([
                'status' => true,
                'category' => $category
            ]);
        } else {
            return view('admin.dashboard');
        }
    }
    // view category///////////////////
    public function viewCat()
    {
        if (Gate::allows('is_admin')) {

            $user = Category::viewCategory();
            // return view('admin.Category.viewcategory', compact('user'));
            return response()->json([
                'status' => true,
                'user' => $user
            ]);
        } else {
            return view('admin.dashboard');
        }
    }
    // edit category///////
    public function editCategory($id)
    {
        if (Gate::allows('is_admin')) {

            $categories = Category::editCategory($id);
            //  view('admin.Category.edit', compact('categories'));
            return response()->json([
                'status' => true,
                'user' => $categories
            ]);
        } else {
            return view('admin.dashboard');
        }
    }
    // update category/////////////////
    public function updateCategory(Request $request, $id)
    {
        if (Gate::allows('is_admin')) {

            $data = $request->only(['name', 'categorytype']);
            $category = Category::updateCat($id, $data);
            return response()->json([
                'status' => true,
                'category' => $category
            ]);
        } else {
            return view('admin.dashboard');
        }
    }

    public function Deletes($id)
    {
        if (Gate::allows('is_admin')) {

            $category = Category::Deletes($id);
            // dd($category);
            $category->delete();
            return response()->json([
                'status' => true,
                'category' => $category
            ]);
        }
    }

    public function Show(Request $request)
    {
        if (Gate::allows('is_admin')) {


            $category = Category::all();
            if ($request->expectsJson()) {
                return response()->json($category);
            } else {
            }
            return view('admin.Category.addcategory');
        } else {
            return view('admin.dashboard');
        }
    }

    // Added category ////////////////////

    public function Category(Request $request)
    {
        if (Gate::allows('is_admin')) {

            // dd($request->all());
            $response = Category::Category($request);

            if (($response['status'])) {
                return redirect()->route('admin.viewcategory')->with('success', 'Category successfully inserted');
            } else {
                return redirect()->back()->with('error', 'Category has not inserted');
            }
            // return response()->json(1);
        } else {
            return view('admin.dashboard');
        }
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
        if (Gate::allows('is_admin')) {

            $user = Category::getAllCategories();
            return view('admin.Category.viewcategory', compact('user'));
        } else {
            return view('admin.dashboard');
        }
    }

    // Edit subcategory ////////////////////

    public function Edit(string $id)
    {
        if (Gate::allows('is_admin')) {

            $categories = Category::find($id);
            // dd($categories);
            return view('admin.Category.edit', compact('categories'));
        } else {
            return view('admin.dashboard');
        }
    }

    // Update category ////////////////////

    public function Update(Request $request)
    {
        if (Gate::allows('is_admin')) {

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
        } else {
            return view('admin.dashboard');
        }
    }
    // Delete subcategory ////////////////////

    public function Delete($id)
    {
        if (Gate::allows('is_admin')) {

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
        } else {
            return view('admin.dashboard');
        }
    }
    // ////////////////////////////////////////////////////////

    public function Categoryfetch()
    {
        if (Gate::allows('is_admin')) {

            $category = Category::all();
            return view('admin.Category.viewcategory');
        } else {
            return view('admin.dashboard');
        }
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
