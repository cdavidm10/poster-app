<?php

class Controller
{
    public function __construct()
    {
    }

    protected function model(String $model,  ?array $data = [])
    {
        require_once SITE_ROOT . 'models/' . $model . '.php';
        return new $model($data);
    }

    protected function view(String $view,  ?array $data = [])
    {
        require_once SITE_ROOT . 'views/' . $view . '.php';
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
