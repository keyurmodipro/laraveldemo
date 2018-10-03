<?php

namespace App\Http\Controllers;

use Request;
use App\User;
use Validator;
use Auth;
use Session;
use Redirect;
use Hash;
use Illuminate\Support\Facades\Input;

class commonController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function login() {

        $input = Request::all();

        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::to('/')->withErrors($validator);
        } else {
            $userdata = array(
                'email' => $input['email'],
                'password' => $input['password']
            );
            // doing login.
            if (Auth::validate($userdata)) {
                if (Auth::attempt($userdata)) {
                    return Redirect::intended('/');
                }
            } else {
                // if any error send back with message.
                Session::flash('error', 'Something went wrong');
                return Redirect::to('/login');
            }
        }
    }

//    public function signup() {
//
//        $input = Request::all();
//
//        $rules = array(
//            'name' => 'required',
//            'email' => 'required|email',
//            'password' => 'required',
//        );
//        $validator = Validator::make($input, $rules);
//        if ($validator->fails()) {
//            return Redirect::to('/')->withErrors($validator);
//        } else {
//            $userdata = array(
//                'email' => $input['email'],
//                'password' => $input['password']
//            );
//            // doing login.
//            if (Auth::validate($userdata)) {
//                if (Auth::attempt($userdata)) {
//                    return Redirect::intended('/');
//                }
//            } else {
//                // if any error send back with message.
//                Session::flash('error', 'Something went wrong');
//                return Redirect::to('/login');
//            }
//        }
//    }

    public function Signup() {
        $input = Request::all();

        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::to('/')->withInput(Input::except('password'))->withErrors($validator);
        } else {
            $input['password'] = Hash::make($input['password']);
            $result = User::create($input);
            if ($result) {
                return Redirect::intended('/login');
            }
        }
    }

    public function Logout() {
        Auth::logout(); // logout user
        return Redirect::to('/'); //redirect back to login
    }

}
