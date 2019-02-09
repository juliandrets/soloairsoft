<?php

namespace App\Http\Controllers;

use App\Wish;
use App\Product;
use App\User;
use Auth;
use Illuminate\Http\Request;

class WishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wishes');
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
        // busco si el usuario tiene este articulo en su lista
        $find_wish = Wish::where('product_id',$request->input('product_id'))->where('user_id', $request->input('user_id'))->first();

        // si no esta en la lista de deseos del usuario lo agrega
        if(!$find_wish) {
            $wish = new Wish([
                'user_id' => $request->input('user_id'),
                'product_id' => $request->input('product_id')
            ]);

            $wish->save();

            return back();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function show(Wish $wish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function edit(Wish $wish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wish $wish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Auth::user()->wishes()->detach($id);

        return redirect('wishes');
    }
}
