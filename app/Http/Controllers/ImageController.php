<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request) {
        $image = $request->file('file');

        $imageName = Str::uuid(). "." .$image->extension();

        $manager = new ImageManager(new Driver);

        $serverImage = $manager::imagick()->read($image);
        $serverImage->cover(1000,1000);

        $imagePath = public_path('uploads') . '/' . $imageName;
        $serverImage->save($imagePath);

        return response()->json([
            'image' =>$imageName
        ]);
    }
}
