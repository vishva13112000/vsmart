<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopcategories = ShopCategory::get();
        return view('admin.shopcategory.index', compact('shopcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shopcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->image;
        $filename = 'shopcategory-' . rand() . '.' . $file->getClientOriginalExtension();
        $request->image->move(public_path('shopcategory'), $filename);
        $shopcategory = new ShopCategory;
        $shopcategory->image = 'shopcategory/' . $filename;
        $shopcategory->title = $request->title;
        $shopcategory->save();
        return response()->Json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopCategory  $shopCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ShopCategory $shopCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopCategory  $shopCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shopcategory = ShopCategory::where('id', $id)->first();
        return view('admin.shopcategory.edit', compact('shopcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShopCategory  $shopCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $shopcategory =  ShopCategory::where('id',$request->id)->first();
        if ($request->image) {
            $file = $request->image;
            $filename = 'shopcategory-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path('shopcategory'), $filename);
            $shopcategory->image = 'shopcategory/' . $filename;
        }
        $shopcategory->title = $request->title;
        $shopcategory->save();
        return response()->Json(['status' => 'success']);
    }


    public function delete(Request $request)
    {
        $shopcategory = ShopCategory::where('id', $request->id)->first();
        $file_path = base_path('public/' . $shopcategory->image);
        unlink($file_path);
        $shopcategory->delete();
        return response()->Json(['status' => 'success']);
    }

    public function deleteall(Request $request)
    {
        $ids = $request->ids;
        $shopcategory=  ShopCategory::whereIn('id',explode(",",$ids))->delete();
        return response()->Json(['status' => 'success']);
    }
    public function assign(Request $request)
    {
        $shopcategory = ShopCategory::where('id', $request->id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
//        dd($request->all());
        $shopcategory = ShopCategory::where('id', $request->id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }
}
