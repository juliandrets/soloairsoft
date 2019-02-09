<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Brand;
use App\Slider;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\ImageManagerStatic as Image;


class SliderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('role:admin', ['only' => array('create', 'edit', 'destroy')]);
    }

    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->paginate(10);

        return view('admin-panel-sliders', ['sliders' => $sliders]);
    }

    public function showOferts() {
        $categories = Category::all();
        $products = Product::where('ofert', '>', 0)->paginate(20);
        $latestProducts = Product::orderBy('id', 'desc')->take(2)->get();
        return view('oferts', [
            'categories' => $categories, 
            'products' => $products,
            'latestProducts' => $latestProducts
        ]);
    }

    public function create()
    {
        $this->middleware('role:admin');

        return view('admin-panel-create-slider');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/sliders/');

            list($width, $height) = getimagesize($image);
            $tumbImage = Image::make($image->getRealPath());
            $tumbImage->resize($width / 2, $height / 2);

            $image->move($destinationPath, $name);
            $tumbImage->save(public_path('/uploads/sliders/tumb/' .$name));

            $product = new Slider([
                'name' => $request->input('name'),
                'picture' => $name,
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'link' => $request->input('link')
            ]);

            $product->save();

            return redirect('adm/sliders/?event=create');
        } else {
            return redirect('/adm/sliders/create/?event=fail-image');
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        $brand = Brand::where('name', $product->brand)->first();
        return view('product-show', ['product' => $product, 'brand' => $brand]);
    }

    public function edit(Slider $slider)
    {
        $this->middleware('role:admin');

        return view('admin-panel-edit-slider', [
            'slider' => $slider
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/sliders/');

            list($width, $height) = getimagesize($image);
            $tumbImage = Image::make($image->getRealPath());
            $tumbImage->resize($width / 2, $height / 2);

            $image->move($destinationPath, $name);
            $tumbImage->save(public_path('/uploads/sliders/tumb/' .$name));

            Slider::find($id)->update([
                'name' => $request->input('name'),
                'picture' => $name,
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'link' => $request->input('link')
            ]);

            return redirect('adm/sliders/?event=update');
        } else {
            Slider::find($id)->update([
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'link' => $request->input('link')
            ]);

            return redirect('adm/sliders/?event=update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return redirect('adm/sliders/?event=delete');
    }

    // Admin Filters
    public function nameFilter()
    {
        $name = Input::get('name');
        $data = Product::where('name', 'like', '%'.$name.'%')->paginate(10);

        return view('admin-panel-products',
            ['products' => $data]
        );
    }
}
