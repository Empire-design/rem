<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function showProduct()
    {
        $product = Product::Product();
        return response()->json(['status' => true, 'product' => $product]);
        //  view('admin.product.product', compact('product'));
    }
    // //////////////////////

    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "idcategory" => "required|exists:categories,id",
            "idsubcategory" => "required|exists:subcategories,id",
            "productname" => "required|string",
            "productimage" => "required|image|mimes:jpeg,png,jpg|max:2048",
            "price" => "required|integer",
            "description" => "required|string",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "error" => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();


        if ($request->hasFile('productimage')) {
            $image = $request->file('productimage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/'), $imageName);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'Product image is required.'
            ], 422);
        }
        $product = Product::addProduct(
            $validated['idcategory'],
            $validated['idsubcategory'],
            $validated['productname'],
            $imageName,
            $validated['description'],
            $validated['price']
        );

        return response()->json([
            'status' => true,
            'product' => $product
        ]);
    }


    // ////////////view product
    public function viewProducts()
    {
        $product = Product::viewProduct();
        return response()->json([
            'status' => true,
            'product' => $product
        ]);
        // view('admin.Product.viewproduct', compact('product'));
    }
    // /////////////////////eidt product
    public function editProducts($id)
    {
        $product = Product::editProduct($id);
        return response()->json(['status' => true, 'product' => $product]);
        // view('admin.Product.editproduct', compact('product'));
    }
    // //////////////////////////update product
    public function updateProduct(Request $request, $id)
    {
        $data = $request->only(['idcategory', 'idsubcategory', 'productname', 'price', 'description', 'imageName']);
        if ($request->hasFile('productimage')) {
            $image = $request->file('productimage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/'), $imageName);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'Product image is required.'
            ], 422);
        }
        $product = Product::updateProduct($id, $data);
        return response()->json([
            'status' => true,
            'product' => $product
        ]);
    }

    // ///////////////////////
    public function productDelete($id)
    {
        $product = Product::Deletes($id);
        // dd($product);
        $product->delete();
        return response()->json([
            'status' => true,
            'category' => $product
        ]);
    }


    // ////////////////////////
    public function Show()
    {
        return view('admin.Product.product');
    }
    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('idcategory', $category_id)->get();
        return response()->json($subcategories);
    }


    public function Product(Request $request)
    {
        $product = new Product();
        $product->productname = $request->productname;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->idcategory = $request->idcategory;
        $product->idsubcategory = $request->idsubcategory;
        if ($request->hasFile('productimage')) {
            $image = $request->file('productimage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $product->productimage = $filename;
        }

        $product->save();
        if (isset($filename)) {
            $product->image()->create([
                'url' => 'images/' . $filename
            ]);
        }
        if ($product) {
            return redirect()->route('product.view')->with('success', 'Product successfully inserted');
        } else {
            return redirect()->back()->with('error', 'Product has not been inserted');
        }
    }

    // //////////////////delte blog
    public function productDetetes($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'status' => true,
            'blog' => $product
        ]);
    }
    public function ViewProduct()
    {
        $category = Category::all();
        $subcategory = Subcategory::all();
        $product = Product::with('categorys', 'subcategorys')->get();

        return view('admin.Product.viewproduct', compact('category', 'subcategory', 'product'));
    }

    // additional method for yajra datatables//////////////////

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with(['categorys', 'subcategorys'])
                ->select('id', 'idcategory', 'idsubcategory', 'productname', 'price', 'productimage', 'description');
            if ($request->category_id) {
                $product->where('idcategory', $request->category_id);
            }
            if ($request->subcategory_id) {
                $product->where('idsubcategory', $request->subcategory_id);
            }
            return DataTables::of($product)
                ->editColumn('idcategory', function ($product) {
                    $categoryname = $product->categorys->name;
                    return $categoryname;
                })
                ->editColumn('idsubcategory', function ($product) {
                    $subcategoryname = $product->subcategorys->subcategoryname;
                    return $subcategoryname;
                })
                ->addColumn('action', function ($product) {
                    $buttons = '';
                    if (Auth::user()->usertype == "admin") {
                        $buttons .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $product->id . '">Delete</button>';
                        $buttons .= '<a href="' . route('admin.edit', $product->id) . '" class="btn btn-success btn-sm">Edit</a>';
                        $buttons .= '<a href="' . route('product.multi', $product->id) . '" class="btn btn-warning btn-sm">View</a>';
                    }
                    // If user is not an admin only show the Edit button
                    else {
                        $buttons .= '<a href="' . route('admin.edit', $product->id) . '" class="btn btn-success btn-sm">Edit</a>';
                    }
                    return $buttons;

                    //  '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $product->id . '">Delete</button>';
                    //     return '<a href="' . route('admin.edit', $product->id) . '" class="btn btn-success btn-sm">Edit</a>';
                })
                // ->addColumn('delete', function ($product) {
                //     if (Auth::user()->usertype == "admin") {

                //         return '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $product->id . '">Delete</button>';
                //     }
                // })
                ->rawColumns(['action'])
                ->make(true);
        }
        $category = Category::all();
        $subcategory = Subcategory::all();
        return view('admin.Product.viewproduct', compact('category', 'subcategory'));
    }
    // ///end here/////////////////////////


    public function Editproduct(string $id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $subcategory = Subcategory::where('idcategory', $product->idcategory)->get();
        return view('admin.Product.editproduct', compact('product', 'category', 'subcategory'));
    }


    // Update product ////////////////////

    // public function ProductUpdate(Request $request, string $id)
    // {

    //     $product = Product::find($request->id);

    //     if (!$product) {
    //         return redirect()->back()->with('error', 'Product not found');
    //     }

    //     $product->idcategory = $request->idcategory;
    //     $product->idsubcategory = $request->idsubcategory;
    //     $product->productname = $request->productname;
    //     $product->price = $request->price;
    //     $product->description = $request->description;

    //     if ($request->hasFile('productimage')) {

    //         $old_images = public_path('images/' . $product->productimage);
    //         if (file_exists($old_images)) {
    //             unlink($old_images);
    //         } else {
    //             return redirect()->back()->with('error', 'Image not deleted');
    //         }
    //     }
    //     if ($request->hasFile('productimage')) {
    //         $image = $request->file('productimage');
    //         $filename = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images'), $filename);
    //         $product->productimage = $filename;
    //     }
    //     $product->save();

    //     if ($product) {
    //         return redirect()->route('product.view')->with('success', ' successfully updated');
    //     } else {
    //         return redirect()->back()->with('error', 'Product not updated');
    //     }
    // }

    public function ProductUpdate(Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($request->id);
        // If the product doesn't exist, return an error
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }


        $product->idcategory = $request->idcategory;
        $product->idsubcategory = $request->idsubcategory;
        $product->productname = $request->productname;
        $product->price = $request->productprice;
        $product->description = $request->description;

        // if ($request->hasFile('productimage')) {
        //     // Delete old image if exists
        //     $old_image_path = public_path('images/' . $product->productimage);
        //     if (file_exists($old_image_path)) {
        //         unlink($old_image_path);
        //     }


        $image = $request->file('productimage');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $filename);
        $product->productimage = $filename;
        $product->save();

        // Return a success message
        return redirect()->route('product.view')->with('success', 'Product successfully updated');
    }

    // Delete Product ////////////////////

    // public function Delete($id)
    // {
    //     $product = Product::find($id);

    // $old_images = public_path('images/' . $product->productimage);
    // if (file_exists($old_images)) {
    //     unlink($old_images);
    //     return redirect()->back()->with('error', 'Deleted successfully');
    // } else {
    //     return redirect()->back()->with('error', 'Image not deleted');
    // }

    //     if ($product) {
    //         $product->delete();

    //         return redirect()->back()->with('success', 'Successfully deleted');
    //     } else {

    //         return  session()->flash('error', 'Product not deleted');
    //     }
    // }

    public function Delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully.'
        ]);
    }
    public function Multishow(string $id)
    {
        $multi = Product::with('image')->find($id);
        $type = 'product';
        return view('admin.Multipleview.pro', compact('multi', 'type'));
    }
}
