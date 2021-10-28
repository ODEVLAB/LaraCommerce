<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.index', compact('categories'));
    }


    public function categoryStatus(Request $request)
    {
        // dd($request->all());
        if ($request->mode == 'true') {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'inactive']);
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
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        return view('backend.category.create', compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
        // dd($data);
        if ($request->is_parent == 1) {
            $data['parent_id'] = null;
        }
        // $data['is_parent'] = $request->input('parent_id', 0);
        dd($data);
        $status = Category::create($data);
        if ($status) {
            return redirect()->route('category.index')->with('success', 'Category Created Succesfully');
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
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        $category = Category::find($id);
        if ($category) {
            return view('backend.category.edit', compact('category', 'parent_cats'));
        } else {
            return back()->with('error', 'Category Not Found');
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
        // dd($request);
        $category = Category::find($id);
        if ($category) {
            $this->validate($request, [
                'title' => 'string|required',
                'summary' => 'string|nullable',
                'is_parent' => 'sometimes|in:1',
                'parent_id' => 'nullable|exists:categories,id',
                'status' => 'required|in:active,inactive',
            ]);
            $data = $request->all(); 
           
            if ($request->is_parent == 1) {
                $data['parent_id'] = null;
            }
            $data['is_parent'] = $request->input('is_parent', 0);
            // dd($data);

            $status = $category->fill($data)->save();
            if ($status) {
                return redirect()->route('category.index')->with('success', 'Category Updated Succesfully');
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
        $category = Category::find($id);
        $child_cat_id = category::where('parent_id', $id)->pluck('id');
        if ($category) {
            $status = $category->delete();
            if ($status) {
                if (count($child_cat_id) > 0) {
                    Category::shiftChild($child_cat_id);
                }
                return redirect()->route('category.index')->with('success', 'Category Succesfully Deleted');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }


    public function getChildByParentID(Request $request, $id)
    {
        //        dd($id);
        //        $child_id = Category::getChildByParentID($request->id);
        //        if(count($child_id)<=0){

        $category = Category::find($request->id);
        if ($category) {
            $child_id = Category::getChildByParentID($request->id);
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            }
            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Category Not Found']);
        }
    }
}
