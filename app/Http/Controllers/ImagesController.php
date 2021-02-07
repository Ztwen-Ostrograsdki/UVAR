<?php

namespace App\Http\Controllers;

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
        $path = null;
        $member = Member::find($id);
        $oldsImages = $member->images;

        $parts = explode(',', $request->image);
        $decoded = base64_decode($parts[1], true);
        $extention = (explode('/', mb_substr($parts[0], 0, strpos($parts[0], ';'))))[1];
        $name = getdate()['year'].''.getdate()['mon'].''.getdate()['hours'].''.getdate()['minutes'].''.getdate()['seconds']. '' .  Str::random(20) . '.' . $extention;

        if (count($oldsImages) > 0) {
            foreach ($oldsImages as $img) {
                $member->images()->detach($img->id);
                $local = Storage::delete($img->name);
                if ($local) {
                    $del_db = $img->delete();
                    if ($del_db) {
                        $stored = Storage::disk('images')->put($name, $decoded);
                        if ($stored) {
                            $intoDB = Image::create(['name' => $name]);
                            if ($intoDB) {
                                $member->images()->attach($intoDB->id);
                                return response()->json(['success' => "Mise à jour du profil réussie"]);
                            }
                        }
                    }
                }
            }
        }
        else{
            $stored = Storage::disk('images')->put($name, $decoded);
            if ($stored) {
                $intoDB = Image::create(['name' => $name]);
                if ($intoDB) {
                    $member->images()->attach($intoDB->id);
                    return response()->json(['success' => "Mise à jour du profil réussie"]);
                }
            }
        }
        
    }


    public function validator(array $data)
    {
        return Validator::make($data, [
            'image' => ['required', 'image', 'file', 'dimensions:min_width=100,min_height=100', 'bail', 'size:max:1'],
        ]);
    }
}
