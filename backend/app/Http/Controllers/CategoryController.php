<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    protected $model = Category::class;

    public function __construct()
    {
        $this->middleware('role:admin', ['only' => array('create', 'edit', 'destroy')]);
    }

    public function index()
    {
        $categories = Category::all();
        $subCategories = Subcategory::all();
        return view('admin-panel-categories', [
            'categories' => $categories,
            'subCategories' => $subCategories
        ]);
    }

    public function create()
    {
        return view('admin-panel-create-category');
    }

    public function store(Request $request)
    {
        // Save pictures
        $picture = $this->createPicture($request, 'categories');

        $category = new Category([
            'name' => $request->input('name'),
            'picture' => $picture
        ]);
        $category->save();


        return redirect('adm/categories?event=create');
    }

    public function show($name)
    {
        $categories = Category::all();

        $categoryTitle = Category::where('name', $name)->first();

        $products = Product::where('category', $name)->orderBy('id', 'desc')->paginate(20);

        $latestProducts = Product::orderBy('id', 'desc')->take(2)->get();

        return view('category', [
            'categoryTitle' => $categoryTitle,
            'categories' => $categories,
            'products' => $products,
            'latestProducts' => $latestProducts
        ]);
    }

    public function showWithFilterPrice(Request $request, $name)
    {
        $min = $request->input('min');
        $max = $request->input('max');

        $categories = Category::all();

        $categoryTitle = Category::where('name', $name)->first();

        $products = Product::where('category', $name)->where('price','>=',$min)->where('price','<=',$max)->orderBy('id', 'desc')->paginate(20);

        // para el aside
        $latestProducts = Product::take(2)->orderBy('id', 'desc');

        return view('category', [
            'categoryTitle' => $categoryTitle,
            'categories' => $categories,
            'products' => $products,
            'latestProducts' => $latestProducts
        ]);

    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin-panel-edit-category', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        // Find model
        $model = $this->model::find($id);

        // Save pictures
        $picture = $this->updatePictures($request, $model->picture, 'categories');

        $model->update([
            'name'    => $request->input('name'),
            'picture' => $picture,
        ]);
        
        return redirect('adm/categories?event=edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('adm/categories?event=delete');

    }
}
