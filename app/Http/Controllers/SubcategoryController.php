<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    // ////// show form////////////
    public function Subcategorys(Request $request)
    {
        dd($request->all());
        $subcategory = Subcategory::subcategory();
        return response()->json(['status' => true, 'subcategory' => $subcategory]);
    }
    public function addSubcategory(Request $request)
    {
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
    }

    // /////////////view subcategory///////
    public function viewSubcategorys()
    {
        $subupdate = Subcategory::viewSubcategory();
        return response()->json(['status' => true, 'subcategory' => $subupdate]);
        // view('admin.Subcategory.viewsubcategory', compact('subupdate'));
    }
    // //////////////edit subcategory///////
    public function editSubcategorys($id)
    {
        $subcategory = Subcategory::editSubcategory($id);
        return response()->json(['status' => true, 'subcategory' => $subcategory]);
        //  view('admin.Subcategory.editsubcategory', compact('subcategory'));
    }
    ////////////////////update subcategory///////
    public function updateSubcategorys(Request $request, $id)
    {
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
    }
    // //////////delete subcategory///////////
    public function subDelete($id)
    {
        $subcategory = Subcategory::Deletes($id);
        $subcategory->delete();
        return response()->json([
            'status' => true,
            'subcategory' => $subcategory
        ]);
    }
    // Show subcategory ////////////////////

    public function show()
    {

        return view('admin.Subcategory.subcategory');
    }

    // Added subcategory ////////////////////

    public function Subcategory(Request $request)
    {
        $subcategory = new Subcategory();
        $subcategory->subcategoryname = $request->subcategoryname;
        $subcategory->idcategory = $request->idcategory;
        $subcategory->save();

        if ($subcategory) {
            return redirect()->back()->with('success', 'Subcategory successfully inserted');
        } else {
            return redirect()->back()->with('error', 'Subcategory has not inserted');
        }
    }

    // View subcategory ////////////////////

    public function Viewsubcategory()
    {
        $subupdate = Subcategory::with('category')->get();
        return view('admin.Subcategory.viewsubcategory', compact('subupdate'));
    }

    // Edit subcategory ////////////////////

    public function Editsubcategory(string $id)
    {
        $subcategory = Subcategory::find($id);
        $category = Category::all();
        return view('admin.Subcategory.editsubcategory', compact('subcategory', 'category'));
    }

    // Update subcategory ////////////////////

    public function Update(Request $request)
    {
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
    }

    // Delete subcategory ////////////////////

    public function Delete($id)
    {
        $subcategory = Subcategory::find($id);

        if ($subcategory) {
            $subcategory->delete();

            return redirect()->back()->with('success', 'Successfully deleted');
        } else {

            return  session()->flash('error', 'Subcategory not deleted');
        }
    }
}
