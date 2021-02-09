<?php

namespace App\ModelsHelpers\ImageStores;

use App\Models\Action;
use App\Models\Image;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Storer{

	public $request;

	/**
	 * The name of the image that will be save in the storage --- unique name
	 * @var [type]
	 */
	public $name;

	/**
	 * id of a model that will be join to an image
	 * @var [type]
	 */
	public $id;

	/**
	 * the decoded encryption of an image that have been into base-64
	 * @var [type]
	 */
	public $decoded;
	public $max = 1;

	public function __construct($request, $id){
		$this->request = $request;
		$this->id = $id;
	}


	public function __MEMBER_STORER()
	{
		$path = null;
		$id = $this->id;
        $member = Member::find($id);
        $oldsImages = $member->images;

        $this->setName();
        $this->setDecoded();
        $decoded = $this->getDecoded();
        $name = $this->getName();

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
                                return true;
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
                    return true;
                }
            }
        }
	}



	/**
	 * To save a image of action in storage and in database
	 * @return [type] [description]
	 */
	public function __ACTION_STORER()
	{
		$path = null;
		$id = $this->id;
        $action = Action::find($id);
        $oldsImages = $action->images;

        $this->setName();
        $this->setDecoded();
        $decoded = $this->getDecoded();
        $name = $this->getName();

        if (count($oldsImages) > $this->max) {
        	$targetImage = $oldsImages[count($oldsImages) - 1];
        	$action->images()->detach($targetImage->id);
            $local = Storage::delete($targetImage->name);

            if ($local) {
                $del_db = $targetImage->delete();
                if ($del_db) {
                    $stored = Storage::disk('images')->put($name, $decoded);
                    if ($stored) {
                        $intoDB = Image::create(['name' => $name]);
                        if ($intoDB) {
                            $action->images()->attach($intoDB->id);
                            return true;
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
                    $action->images()->attach($intoDB->id);
                    return true;
                }
            }
        }
	}




	





    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName()
    {
        $parts = explode(',', $this->request);
        $extention = (explode('/', mb_substr($parts[0], 0, strpos($parts[0], ';'))))[1];
        $name = getdate()['year'].''.getdate()['mon'].''.getdate()['hours'].''.getdate()['minutes'].''.getdate()['seconds']. '' .  Str::random(20) . '.' . $extention;
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDecoded()
    {
        return $this->decoded;
    }

    /**
     * @param mixed $decoded
     *
     * @return self
     */
    public function setDecoded()
    {
    	$parts = explode(',', $this->request);
        $decoded = base64_decode($parts[1], true);
        $this->decoded = $decoded;

        return $this;
    }
}