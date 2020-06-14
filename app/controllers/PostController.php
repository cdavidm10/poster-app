<?php

class PostController extends Controller
{
    public function index(): void
    {
        $authenticator = new Authenticator();
        if (!$authenticator->isLogged()) {
            header("Location: /");
        } else {
            $user = $authenticator->getUser();
            echo "Posts from: " . $user->getUsername();
            var_dump($user);
        }
    }
}
