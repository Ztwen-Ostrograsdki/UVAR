<?php

namespace App\Http\Controllers;

use App\ModelsHelpers\ImageStores\Storer;
use App\Models\Image;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ImagesController extends Controller
{
    

	/**
	 * To create a new image in storage local and put it in database
	 * @param  ImageRequest $request [description]
	 * @return [type]                [description]
	 */
    public function forMember(Request $request, int $id)
    {
        $storer = (new Storer($request->image, $id))->__MEMBER_STORER();
        if ($storer) {
            return response()->json(['success' => "Mise à jour réussie"]);
        }
        else{
            return response()->json(['errors' => "Echec de mise à jour"]);
        }
    }


    public function validator(array $data)
    {
        return Validator::make($data, [
            'image' => ['required', 'image', 'file', 'dimensions:min_width=100,min_height=100', 'bail', 'size:max:1'],
        ]);
    }
}
