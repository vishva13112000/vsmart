<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\Products;
use App\Models\Category;
use App\Models\Brands;
use App\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

          $data["product"] = Products::get();
        // $data['categories'] = Category::where('active',1)->get();
       
       

        // return view('donates.create')->with($data);
        return view('admin.products.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $subscription = new Subscriptions;
        // $subscription->name = $request->name;
        // $subscription->duration = $request->duration;
        // $subscription->durationtype = $request->durationtype;
        // $subscription->price = $request->price;
        // $subscription->subscriptiontype = $request->subscriptiontype;

        // $subscription->save();
        // return response()->Json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopCategory  $shopCategory
     * @return \Illuminate\Http\Response
     */
    // public function show(ShopCategory $shopCategory)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopCategory  $shopCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $subscription = Subscriptions::where('id', $id)->first();
        // return view('admin.subscription.edit', compact('subscription'));
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
    //     $subscription =  Subscriptions::where('id',$request->id)->first();
        
      
    //     $subscription->name = $request->name;
    //     $subscription->duration = $request->duration;
    //     $subscription->durationtype = $request->durationtype;
    //     $subscription->price = $request->price;
    //     $subscription->subscriptiontype = $request->subscriptiontype;

    //     $subscription->save();
     
    //     return response()->Json(['status' => 'success']);
    }


    public function delete(Request $request)
    {
        // $shopcategory = ShopCategory::where('id', $request->id)->first();
        // $file_path = base_path('public/' . $shopcategory->image);
        // unlink($file_path);
        // $shopcategory->delete();
        // return response()->Json(['status' => 'success']);
    }

    public function deleteall(Request $request)
    {
        // $ids = $request->ids;
        // $subscription=  Subscriptions::whereIn('id',explode(",",$ids))->delete();
        // return response()->Json(['status' => 'success']);
    }
    public function assign(Request $request)
    {
        $products = Products::where('id', $request->id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
//        dd($request->all());
        $products = Subscriptions::where('id', $request->id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }
}
