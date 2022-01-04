<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $products = Product::orderBy('id', 'DESC')->paginate(10);
        $products = Product::orderBy('id', 'DESC')->get();
        return view('backend.products.index', compact('products'));
    }

    public function productStatus(Request $request)
    {
        // dd($request->all());
        if ($request->mode == 'true') {
            DB::table('products')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('products')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Succesfully Updated Status', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'summary' => 'required|string|between:30,400',
            'description' => 'nullable|min:3|max:2000',
            'stock' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'discount' => 'numeric|nullable',
            // 'photo' => 'required|image|mimes:png,jpg,jpeg,svg',
            'photo' => 'required',
            'brand_id' => 'required|integer|exists:brands,id',
            'cat_id' => 'required|integer|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            // 'vendor_id' => 'required|integer|exists:vendors,id',
            'size' => 'nullable|in:S,M,L,XL',
            'conditions' => 'nullable|in:new,popular,winter',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();
        // dd($data);

        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time() .'-'.$slug;
        }
        $data['slug'] = $slug;
        $data['offer_price'] = ($request->price - (($request->price * $request->discount)/100));

        // dd($data);

        $status = Product::create($data);
        if ($status) {
            return redirect()->route('product.index')->with('success', 'Product Created Succesfully');
        } else {
            return back()->with('error', 'Oops Error Occured');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if($product){
            return view('backend.products.view', compact(['product']));
        }
        else{
            return back()->with('error', 'Product Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            return view('backend.products.edit', compact('product'));
        } else {
            return back()->with('error', 'Product Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $this->validate($request, [
                'title' => 'required|string',
                'summary' => 'required|string|between:30,400',
                'description' => 'nullable|min:3|max:2000',
                'stock' => 'numeric|nullable',
                'price' => 'numeric|nullable',
                'discount' => 'numeric|nullable',
                'photo' => 'required',
                'brand_id' => 'required|integer|exists:brands,id',
                'cat_id' => 'required|integer|exists:categories,id',
                'child_cat_id' => 'nullable|exists:categories,id',
                // 'vendor_id' => 'required|integer|exists:vendors,id',
                'size' => 'nullable|in:S,M,L,XL',
                'conditions' => 'nullable|in:new,popular,winter',
                'status' => 'required|in:active,inactive',
            ]);
            $data = $request->all(); 
            // dd($data);
            $data['offer_price'] = ($request->price - (($request->price * $request->discount)/100));
            // dd($data);
            $status = $product->fill($data)->save();
            if ($status) {
                return redirect()->route('product.index')->with('success', 'Product Updated Succesfully');
            } else {
                return back()->with('error', 'Something Went Wrong');
            }
            } else {
                return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $status = $product->delete();
            if ($status) {
                return redirect()->route('product.index')->with('success', 'Product Succesfully Deleted');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }
}
