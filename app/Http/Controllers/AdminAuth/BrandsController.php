<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\Brands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brandss = Brands::get();
        return view('admin.brands.index', compact('brandss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
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
        $filename = 'brands-' . rand() . '.' . $file->getClientOriginalExtension();
        $request->image->move(public_path('brands'), $filename);
        $brands = new Brands;
        $brands->image = 'brands/' . $filename;
        $brands->title = $request->title;
        $brands->save();
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
        $brands = Brands::where('id', $id)->first();
        return view('admin.brands.edit', compact('brands'));
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
        $brands =  Brands::where('id',$request->id)->first();
        if ($request->image) {
            $file = $request->image;
            $filename = 'brands-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path('brands'), $filename);
            $brands->image = 'brands/' . $filename;
        }
        $brands->title = $request->title;
        $brands->save();
        return response()->Json(['status' => 'success']);
    }


    public function delete(Request $request)
    {
        $brands = Brands::where('id', $request->id)->first();
        $file_path = base_path('public/' . $brands->image);
        unlink($file_path);
        $brands->delete();
        return response()->Json(['status' => 'success']);
    }

    public function deleteall(Request $request)
    {
        $ids = $request->ids;
        $brands= Brands::whereIn('id',explode(",",$ids))->delete();
        return response()->Json(['status' => 'success']);
    }
    public function assign(Request $request)
    {
        $brands = Brands::where('id', $request->id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
//        dd($request->all());
        $brands = Brands::where('id', $request->id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }
}
