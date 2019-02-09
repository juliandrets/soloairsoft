<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Wish;
use App\Product;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notifications');
    }

    public function get() {
        $wishes = Wish::where('user_id', Auth::user()->id)->get();
        $products = [];
        
        // guardo en el array productos los productos que estan en oferta en la  lista de deseos
        foreach ($wishes as $wish) {
            $product = Product::find($wish->product_id);
            if($product->ofert > 0) {
                $products[] = $product;
            }
        }

        for ($i=0; $i < count($products); $i++) { 
            $buscar_noti = Notification::where('product_id', $products[$i]->id)->first();

            if(!$buscar_noti) {
                $notification = new Notification([
                    'user_id' => Auth::user()->id,
                    'product_id' => $products[$i]->id,
                    'message' => 'Un producto de tu lista de deseos esta en oferta!'
                ]);
                $notification->save();
            }
        }


        $notifications = Notification::where('user_id', Auth::user()->id)->get();
        $countnotifications = count($notifications);
        return $countnotifications;
    }

    public function update() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Auth::user()->notifications()->detach($id);

        return redirect('notifications');
    }
}
