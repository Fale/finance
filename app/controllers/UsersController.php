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
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password'))))
            return Redirect::to('/')->with('message', 'You are now logged in!');
        else
            return Redirect::to('users/login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('users/login')->with('message', 'Your are now logged out!');
    }
}
