<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetImageController extends Controller
{
    public function getImage($image_name) {
        $url = public_path().'/img/companies/'.$image_name;
        $file = file_get_contents($url);
        $type = pathinfo($file, PATHINFO_EXTENSION);
        return response()->json(['image' => 'data:image/'.$type.';base64,'.base64_encode($file)]);
    }
}
