<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SearchController extends Controller
{
    public function index(Request $request) {

    	$search = $request->input('search');

    	$searchProducts = Product::where('name','like', '%'.$search.'%')->orderBy('id','desc')->paginate(20);

    	$categories = Category::all();

        $latestProducts = Product::orderBy('id', 'desc')->take(2)->get();

        return view('search', [
            'searchProducts' => $searchProducts,
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'search' => $search
        ]);
    }

    public function showWithFilterPrice(Request $request)
    {
        $search = $request->input('search');

        $min = $request->input('min');
        $max = $request->input('max');

        $searchProducts = Product::where('name','like', '%'.$search.'%')->where('price','>=',$min)->where('price','<=',$max)->orderBy('id', 'desc')->paginate(20);

    	$categories = Category::all();

        $latestProducts = Product::orderBy('id', 'desc')->take(2)->get();

        return view('search', [
            'searchProducts' => $searchProducts,
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'search' => $search
        ]);

    }
}
