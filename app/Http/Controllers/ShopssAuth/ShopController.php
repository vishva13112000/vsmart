<?php

namespace App\Http\Controllers\ShopssAuth;

use App\Models\Shops;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shops::get();
        return view('shopss.shop.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shopss.shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $shop = new Shops;
        $shop->name = $request->name;
        $shop->ownername = $request->ownername;
        $shop->email = $request->email;
        $shop->contact = $request->contact;
        $shop->address = $request->address;
        $shop->save();
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
        $shop = Shops::where('id', $id)->first();
        return view('shopss.shop.edit', compact('shop'));
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
        $shop =  Shops::where('id',$request->id)->first();
        
        $shop->name = $request->name;
        $shop->ownername = $request->ownername;
        $shop->email = $request->email;
        $shop->contact = $request->contact;
        $shop->address = $request->address;
        $shop->save();
        return response()->Json(['status' => 'success']);
    }


    public function delete(Request $request)
    {
        $shop = Shops::where('id', $request->id)->first();
        $shop->delete();
        return response()->Json(['status' => 'success']);
    }

    public function deleteall(Request $request)
    {
        $ids = $request->ids;
        $shop=  Shops::whereIn('id',explode(",",$ids))->delete();
        return response()->Json(['status' => 'success']);
    }
    public function assign(Request $request)
    {
        $shop = Shops::where('id', $request->id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
//        dd($request->all());
        $shop = Shops::where('id', $request->id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }
}
