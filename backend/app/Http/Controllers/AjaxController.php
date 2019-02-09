<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class AjaxController extends Controller
{
    public function updateSubCategorySelect($id)
    {
        $data = Subcategory::where('category_id', $id)->get();
        dd($data);
    }
}
