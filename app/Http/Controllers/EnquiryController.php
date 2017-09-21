<?php
namespace App\Http\Controllers;
use Input;
use Validator;
use Redirect;
use Session;

class EnquiryController extends Controller {
    public function index()
    {
        $data = Input::all();
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'g-recaptcha-response' => 'required|captcha', 
            'msg' => 'required',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return Redirect::to('/contact')->withInput()->withErrors($validator);
        }
        else{
            // Do your stuff.
        }
    }
}