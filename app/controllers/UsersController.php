<?php

class UsersController extends BaseController {

    protected $layout = "layout";

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    public function getLogin() {
        $this->layout->content = View::make('login');
    }

    public function postSignin() {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
            Session::put('userId', User::where('email', Input::get('email'))->pluck('id'));
            return Redirect::to('/')->with('message-success', 'You are now logged in!');
        } else
            return Redirect::to('users/login')
                ->with('message-error', 'Your username/password combination was incorrect')
                ->withInput();
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('users/login')->with('message-success', 'Your are now logged out!');
    }
}
