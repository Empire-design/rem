<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    // ////// show form////////////
    public function Subcategorys(Request $request)
    {
        if (Gate::allows('is_admin')) {

            dd($request->all());
            $subcategory = Subcategory::subcategory();
            return response()->json(['status' => true, 'subcategory' => $subcategory]);
        } else {
            return view('admin.dashboard');
        }
    }
    public function addSubcategory(Request $request)
    {
        if (Gate::allows('is_admin')) {

            $validator = Validator::make($request->all(), [
                "idcategory" => "required|exists:categories,id",
                "subcategoryname" => "required|string",
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "error" => $validator->errors()
                ], 422);
            }
            $validator = $validator->validated();
            $subcategory = Subcategory::addSubcategory($request->idcategory, $request->subcategoryname);
            return response()->json([
                "status" => true,
                "subcategory" => $subcategory
            ]);
        } else {
            return view('admin.dashboard');
        }
    }

    // /////////////view subcategory///////
    public function viewSubcategorys()
    {
        if (Gate::allows('is_admin')) {

            $subupdate = Subcategory::viewSubcategory();
            return response()->json(['status' => true, 'subcategory' => $subupdate]);
            // view('admin.Subcategory.viewsubcategory', compact('subupdate'));
        } else {
            return view('admin.dashboard');
        }
    }
    // //////////////edit subcategory///////
    public function editSubcategorys($id)
    {
        if (Gate::allows('is_admin')) {

            $subcategory = Subcategory::editSubcategory($id);
            return response()->json(['status' => true, 'subcategory' => $subcategory]);
            //  view('admin.Subcategory.editsubcategory', compact('subcategory'));
        } else {
            return view('admin.dashboard');
        }
    }
    ////////////////////update subcategory///////
    public function updateSubcategorys(Request $request, $id)
    {
        if (Gate::allows('is_admin')) {

            $validator = Validator::make($request->all(), [
                "idcategory" => "required|exists:categories,id",
                "subcategoryname" => "required|string",
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "error" => $validator->errors()
                ], 422);
            }
            $validator = $validator->validated();
            $data = $request->only(['idcategory', 'subcategoryname']);
            $subcategory = Subcategory::updateSubcategory($id, $data);
            return response()->json([
                'status' => true,
                'subcategory' => $subcategory
            ]);
        } else {
            return view('admin.dashboard');
        }
    }
    // //////////delete subcategory///////////
    public function subDelete($id)
    {
        if (Gate::allows('is_admin')) {

            $subcategory = Subcategory::Deletes($id);
            $subcategory->delete();
            return response()->json([
                'status' => true,
                'subcategory' => $subcategory
            ]);
        } else {
            return view('admin.dashboard');
        }
    }
    // Show subcategory ////////////////////

    public function show()
    {
        if (Gate::allows('is_admin')) {

            return view('admin.Subcategory.subcategory');
        } else {
            return view('admin.dashboard');
        }
    }

    // Added subcategory ////////////////////

    public function Subcategory(Request $request)
    {
        if (Gate::allows('is_admin')) {

            $subcategory = new Subcategory();
            $subcategory->subcategoryname = $request->subcategoryname;
            $subcategory->idcategory = $request->idcategory;
            $subcategory->save();

            if ($subcategory) {
                return redirect()->back()->with('success', 'Subcategory successfully inserted');
            } else {
                return redirect()->back()->with('error', 'Subcategory has not inserted');
            }
        } else {
            return view('admin.dashboard');
        }
    }


    // View subcategory ////////////////////

    public function Viewsubcategory()
    {
        if (Gate::allows('is_admin')) {

            $subupdate = Subcategory::with('category')->get();
            return view('admin.Subcategory.viewsubcategory', compact('subupdate'));
        } else {
            return view('admin.dashboard');
        }
    }

    // Edit subcategory ////////////////////

    public function Editsubcategory(string $id)
    {
        if (Gate::allows('is_admin')) {

            $subcategory = Subcategory::find($id);
            $category = Category::all();
            return view('admin.Subcategory.editsubcategory', compact('subcategory', 'category'));
        } else {
            return view('admin.dashboard');
        }
    }

    // Update subcategory ////////////////////

    public function Update(Request $request)
    {
        if (Gate::allows('is_admin')) {

            $subcategory = Subcategory::find($request->id);

            if (!$subcategory) {
                return redirect()->back()->with('error', 'Subcategory not found');
            }
            $subcategory->subcategoryname = $request->subcategoryname;
            $subcategory->idcategory = $request->idcategory;
            $subcategory->save();
            if ($subcategory) {

                return response()->json(["result" => "Successfully updated"]);
            } else {
                return redirect()->back()->with('error', 'Subcategory not updated');
            }
        } else {
            return view('admin.dashboard');
        }
    }

    // Delete subcategory ////////////////////

    public function Delete($id)
    {
        if (Gate::allows('is_admin')) {

            $subcategory = Subcategory::find($id);

            if ($subcategory) {
                $subcategory->delete();

                return redirect()->back()->with('success', 'Successfully deleted');
            } else {

                return  session()->flash('error', 'Subcategory not deleted');
            }
        } else {
            return view('admin.dashboard');
        }
    }
}
