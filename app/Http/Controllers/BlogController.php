<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Subcategory;
use Hoa\Compiler\Llk\TreeNode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Image;
use DeepCopy\f001\B;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function Blog()
    {
        $blog = Blog::Blog();
        return response()->json(['status' => true, 'blog' => $blog]);
        //  view('admin.Blog.addblog', compact('blog'));
    }
    public function addBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idcategory' => 'required|exists:categories,id',
            'idsubcategory' => 'required|exists:subcategories,id',
            'name' => 'required|string',
            "image" => "required|image|mimes:jpeg,png,jpg",
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'blog' => $validator->errors()
            ]);
        }

        $validated = $validator->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/'), $imageName);
        } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
        $blog = Blog::addBlog(
            $validated['idcategory'],
            $validated['idsubcategory'],
            $validated['price'],
            $validated['name'],
            $imageName,
            $validated['description'],
        );

        return response()->json([
            'status' => true,
            'blog' => $blog
        ]);
    }
    
    // //////////////////view blog///////
    public function viewBlog()
    {
        $blog = Blog::viewBlog();
        return response()->json([
            'status' => true,
            'blog' => $blog
        ]);
        // view('admin.Blog.viewblog', compact('blog'));
    }
    // //////////////////edit blog

    public function editBlogs($id)
    {
        $blog = Blog::editBlog($id);
        return response()->json([
            'status' => true,
            'blog' => $blog
        ]);
        //  view('admin.Blog.edit', compact('blog'));
    }

    // //////////////////update blog
    public function updateBlog(Request $request, $id)
    {
        $data = $request->only(['idcategory', 'idsubcategory', 'name', 'price', 'image', 'description']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/'), $imageName);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'Blog image is required'
            ]);
        }
        $blog = Blog::updateBlog($id, $data);
        return response()->json([
            'status' => true,
            'blog' => $blog
        ]);
    }

    // /////////////////////delte blog
    public function blogDetete($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json([
            'status' => true,
            'blog' => $blog
        ]);
    }






    // //////////////////////////////////////////////////////////////////
    public function Show()
    {
        $blog = Blog::with('image')->get();
        return view(
            'admin.Blog.addblog'
        );
    }
    // public function store(Request $requeset)
    // {
    //     $blog = new Blog();
    //     $blog->name = $requeset->name;
    //     $blog->idcategory = $requeset->idcategory;
    //     $blog->idsubcategory = $requeset->idsubcategory;
    //     $blog->price = $requeset->price;

    //     if ($requeset->hasFile('image')) {
    //         $image = $requeset->file('image');
    //         $filename = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images'), $filename);
    //         $blog->image = $filename;
    //     }
    //     $blog->save();
    //     $blog->image()->create([
    //         $blog->url => "images\blog\img.png",
    //     ]);

    //     if ($blog) {
    //         return redirect()->route('blog.viewblog')->with('success', 'successfully');
    //     } else {
    //         return redirect()->back()->with('res', 'not added');
    //     }
    // }

    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->name = $request->name;
        $blog->idcategory = $request->idcategory;
        $blog->idsubcategory = $request->idsubcategory;
        $blog->description = $request->description;
        $blog->price = $request->price;

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $filename = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images'), $filename);
        }

        $blog->save();

        if (isset($filename)) {
            $blog->image()->create([
                'url' => 'images/' . $filename
            ]);
        }

        return redirect()->route('viewblog')->with('success', 'Successfully added');
    }


    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('idcategory', $category_id)->get();
        return response()->json($subcategories);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $blog = Blog::with(['categorys', 'subcategorys', 'image'])
                ->select('id', 'idcategory', 'idsubcategory', 'name', 'price', 'description');
            if ($request->category_id) {
                $blog->where('idcategory', $request->category_id);
            }
            if ($request->subcategory_id) {
                $blog->where('idsubcategory', $request->subcategory_id);
            }
            return DataTables::of($blog)
                ->addColumn('image', function ($blog) {
                    if ($blog->image->url) {
                        return asset($blog->image->url);
                    }
                })
                ->editColumn('idcategory', function ($blog) {
                    $categoryname = $blog->categorys->name;
                    return $categoryname;
                })
                ->editColumn('idsubcategory', function ($blog) {
                    $subcategoryname = $blog->subcategorys->subcategoryname;
                    return $subcategoryname;
                })
                ->addColumn('action', function ($blog) {
                    $buttons = '';
                    if (Auth::user()->usertype == "admin") {
                        $buttons .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $blog->id . '">Delete</button>';
                        $buttons .= '<a href="' . route('edit', $blog->id) . '" class="btn btn-success btn-sm">Edit</a>';
                        $buttons .= '<a href="' . route('blog.multi', $blog->id) . '" class="btn btn-warning btn-sm">View</a>';
                    }
                    // If user is not an admin only show the Edit button
                    else {
                        $buttons .= '<a href="' . route('edit', $blog->id) . '" class="btn btn-success btn-sm">Edit</a>';
                    }
                    return $buttons;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $category = Category::all();
        $subcategory = Subcategory::all();
        return view('admin.Blog.viewblog', compact('category', 'subcategory'));
    }
    public function Editblog(string $id)
    {
        // dd($request->all());

        $blog = Blog::find($id);
        $category = Category::all();
        $subcategory = Subcategory::where('idcategory', $blog->idcategory)->get();
        return view('admin.Blog.edit', compact('blog', 'category', 'subcategory'));
    }

    public function BlogUpdate($request)
    {
        self:
        // dd($request->all());
        $blog = Blog::findOrFail($request->id);
        if (!$blog) {
            return ['error', 'Blog not found'];
        }
        $blog->idcategory = $request->idcategory;
        $blog->idsubcategory = $request->idsubcategory;
        $blog->name = $request->name;
        $blog->price = $request->price;
        $blog->description = $request->description;

        // if ($request->hasFile('productimage')) {
        //     // Delete old image if exists
        //     $old_image_path = public_path('images/' . $product->productimage);
        //     if (file_exists($old_image_path)) {
        //         unlink($old_image_path);
        //     }


        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $filename);
        $blog->save();
        if (isset($filename)) {
            $blog->image()->create([
                'url' => 'images/' . $filename
            ]);
            // $blog->image = $filename;
        }

        return redirect()->route('viewblog')->with('success', 'Product successfully updated');
    }



    public function Delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Blog deleted successfully.'
        ]);
    }



    public function Multishow(string $id)
    {
        $multi = Blog::with('image')->find($id);
        $type = 'blog';
        return view('admin.Multipleview.index', compact('multi', 'type'));
    }
    public function Apifetch()
    {
        $api = ["name" => "saif", "class" => "bscs", "city" => "faisalabad", "number" => 123, "country" => "Pakistan", "sector" => "askari cantt", "block" => 2];
        return $api;
    }
}
