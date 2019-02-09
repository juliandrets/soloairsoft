<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CouponController extends Controller
{
    
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin-panel-coupons', ['coupons' => $coupons]);
    }

    public function applyCoupon(Request $request) {
        $coupon = Coupon::where('name', $request->input('coupon'))->first();
        if($coupon) {
            //return redirect()->back()->with('coupon', [$coupon]);
            return view('cart', ['coupon' => $coupon]);
        } else {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-panel-create-coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = new Coupon([
            'name' => $request->input('name'),
            'value' => $request->input('value')
        ]);

        $coupon->save();

        return redirect('adm/coupons');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin-panel-edit-coupon', ['coupon' => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Coupon::find($id)->update([
            'name' => $request->input('name'),
            'value' => $request->input('value')
        ]);

        return redirect('adm/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect('adm/coupons');
    }
}
