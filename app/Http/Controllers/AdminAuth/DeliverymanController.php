<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\Products;
use App\Models\Deliveryman;
use App\Models\Brands;
use App\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliverymanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverymans = Deliveryman::get();
        return view('admin.deliveryman.index', compact('deliverymans'));
    }


    public function delivery($id)
    {
     
        $shop = Shop::findorFail($id);
        $deliverymans = Deliveryman::where('deleted_at',null)->where('shopid', $id)->get();
        // dd($deliverymans);
        return view('admin.deliveryman.create', compact('shop', 'deliverymans'));

    }

 
    public function create()
    {
        
        $shops = Shop::where('active',1)->get();
        return view('admin.deliveryman.create',compact('shops'));
    }

   
    public function store(Request $request)
    {
       // dd($request->all());
         $deliveryman=new Deliveryman();
        $deliveryman->name=$request->name;
        $deliveryman->shopid=$request->shopid;
        $deliveryman->email=$request->email;
        $deliveryman->address=$request->address;
        $deliveryman->contactno=$request->contactno;
       
        $deliveryman->save();
         return response()->Json(['status' => 'success']);
    }


    // public function show(ShopCategory $shopCategory)
    // {
    //     //
    // }


    public function edit($id)
    {
    
         $deliveryman= Deliveryman::where('id',$id)->first();
        $shops = Shop::where('active',1)->get();
         return view('admin.deliveryman.edit', compact('shops'));
    }


    public function update(Request $request)
    {
        $deliveryman= Deliveryman::where('id',$request->id)->first();
         $deliveryman->name=$request->name;
        $deliveryman->shopid=$request->shopid;
        $deliveryman->email=$request->email;
        $deliveryman->address=$request->address;
        $deliveryman->contactno=$request->contactno;
      
        $deliveryman->save();
         return response()->Json(['status' => 'success']);
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
        // $products = Products::where('id', $request->id)->update(['active' => 1]);
        // return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        // dd($request->all());
        // $products = Products::where('id', $request->id)->update(['active' => 0]);
        // return response()->Json(['status' => 'success']);
    }
}
