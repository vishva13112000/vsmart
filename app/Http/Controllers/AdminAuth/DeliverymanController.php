<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Deliveryman;
use App\Shop;
use Illuminate\Http\Request;

class DeliverymanController extends Controller
{
    public function index($id)
    {
        $deliverymans = Deliveryman::where('shopid', $id)->orderBy('id', 'desc')->get();
        return view('admin.deliveryman.index', compact('deliverymans', 'id'));
    }


    public function create($id)
    {
        $shop = Shop::where('id', $id)->first();
        return view('admin.deliveryman.create', compact('shop', 'id'));
    }


    public function store(Request $request)
    {
        $deliveryman = new Deliveryman();
        $deliveryman->name = $request->name;
        $deliveryman->shopid = $request->id;
        $deliveryman->email = $request->email;
        $deliveryman->address = $request->address;
        $deliveryman->contactno = $request->contactno;
        $deliveryman->save();
        return response()->Json(['status' => 'success']);
    }


    // public function show(ShopCategory $shopCategory)
    // {
    //     //
    // }


    public function edit($id)
    {

        $deliveryman = Deliveryman::where('id', $id)->first();

        return view('admin.deliveryman.edit', compact('deliveryman'));
    }


    public function update(Request $request)
    {
        $deliveryman = Deliveryman::where('id', $request->id)->first();
        $deliveryman->name = $request->name;
        $deliveryman->shopid = $request->shopid;
        $deliveryman->email = $request->email;
        $deliveryman->address = $request->address;
        $deliveryman->contactno = $request->contactno;

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
         $deliverman = Deliveryman::where('id', $request->id)->update(['active' => 1]);
         return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        // dd($request->all());
         $deliverman = Deliveryman::where('id', $request->id)->update(['active' => 0]);
         return response()->Json(['status' => 'success']);
    }
}
