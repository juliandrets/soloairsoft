<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;
    protected $route;

    protected function createPicture($request, $folder)
    {
        $name = 'sinfoto.jpg';

        if ($image = $request->file('picture')) {
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/' . $folder . '/');

            try {
                list($width, $height) = getimagesize($image);
            } catch (\Exception $ex) {
                $name = 'sinfoto.jpg';
                return $name;
            }

            $tumbImage = Image::make($image->getRealPath());
            $tumbImage->resize($width / 2, $height / 2);

            $image->move($destinationPath, $name);
            $tumbImage->save(public_path('/uploads/' . $folder . '/tumb/' . $name));
        }

        return $name;

    }

    protected function updatePictures($request, $pictureName, $folder)
    {
        $name = $pictureName;

        if ($image = $request->file('picture')) {
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/' . $folder . '/');

            try {
                list($width, $height) = getimagesize($image);
            } catch (\Exception $ex) {
                $name = 'sinfoto.jpg';
                return $name;
            }

            $tumbImage = Image::make($image->getRealPath());
            $tumbImage->resize($width / 2, $height / 2);

            $image->move($destinationPath, $name);
            $tumbImage->save(public_path('/uploads/' . $folder . '/tumb/' . $name));
        }

        return $name;
    }

    protected function response($data)
    {
        return response()->json($data,200, [],JSON_PRETTY_PRINT);
    }
}
