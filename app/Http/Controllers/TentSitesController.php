<?php

namespace App\Http\Controllers;

use App\Models\TentSites;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class TentSitesController extends Controller
{
    use RestControllerTrait;
    const MODEL = 'App\Models\TentSites';
    protected $validationRules = ['photo' => 'required', 'title' => 'required'];


    public function store(Request $request)
    {
        /**
         * @var TentSites $m
         */
        $m = self::MODEL;
        try {
            // Receive file
            /**
             * @var Validator $v
             */
            $v = \Validator::make($request->all(), $this->validationRules);
            if($v->fails()) {
                throw new \Exception("ValidationException");
            }

            // Save data and use id to store image
            $post = $request->all();
            if(isset($post['photo'])) {
                unset($post['photo']);
            }
            $data = $m::create($post);

            if($request->hasFile('photo')) {
                $imageName =  env('TENT_SITE_PHOTO_DIR').$data->getAttribute('id'). '.' .
                    $request->file('photo')->getClientOriginalExtension();
                \Storage::put(env('TENT_SITE_PHOTO_DIR').$imageName, $request->file('photo'));
                $data->setAttribute('img_location', $imageName);
                $data->save();
            }

            return $this->createdResponse($data);
        } catch(\Exception $ex) {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }

    }


}
