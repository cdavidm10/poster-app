<?php

class HomeController extends Controller
{
    public function index()
    {
        $authenticator = new Authenticator();
        if (!$authenticator->isLogged()) {
            $this->view('home');
        } else {
            header("Location: /post/");
        }
    }
}
