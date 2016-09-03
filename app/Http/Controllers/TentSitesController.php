<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentSitesController extends Controller
{
    use RestControllerTrait;
    const MODEL = 'App\Models\TentSites';
    protected $validationRules = ['photo' => 'required', 'title' => 'required'];


    public function store(Request $request)
    {
        $m = self::MODEL;
        try
        {
            // Recieve file
            $v = \Validator::make($request->all(), $this->validationRules);
            if($v->fails())
            {
                throw new \Exception("ValidationException");
            }

            if($request->hasFile('photo')) {
                $img_location = $request->photo->store('images');
return $img_location;
                dd($img_location);
            }


            $data = $m::create(\Request::all());
            return $this->createdResponse($data);
        }catch(\Exception $ex)
        {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }

    }

}
