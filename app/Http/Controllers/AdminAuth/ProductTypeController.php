<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductTypeValue;
class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producttypes = ProductType::get();
        return view('admin.producttype.index', compact('producttypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('admin.producttype.create');



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
       
      
        $producttype = new ProductType;
        $producttype->name = $request->name;
        $producttype->save(); 
        foreach($request->value as $value){
         ProductTypeValue::create(['producttypeid'=>$producttype->id,'value'=>$value]);   
        }
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
        $producttype = ProductType::where('id', $id)->first();
        $producttypevalues=ProductTypeValue::where('producttypeid', $id)->get();

        return view('admin.producttype.edit', compact('producttype','producttypevalues'));
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
        $producttype =  ProductType::where('id',$request->id)->first();
       
        $producttype->name = $request->name;
        $producttype->save();
         foreach($request->value as $value){
         if(!empty($value)){
         ProductTypeValue::create(['producttypeid'=>$producttype->id,'value'=>$value]);   
        }
        }
        return response()->Json(['status' => 'success']);
    }


    public function delete(Request $request)
    {
                dd($request->all());
            }

    public function deleteall(Request $request)
    {
        $ids = $request->ids;
        $producttype=  ProductType::whereIn('id',explode(",",$ids))->delete();
        return response()->Json(['status' => 'success']);
    }
    public function assign(Request $request)
    {
        $producttype = ProductType::where('id', $request->id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
// //        dd($request->all());
        $producttype = ProductType::where('id', $request->id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }
}
