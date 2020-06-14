<?php

class App
{

    protected String $controller_name = DEFAULT_CONTROLLER;
    protected String $action = DEFAULT_ACTION;
    protected array $url_data;
    protected Controller $controller;
    protected array $params = [];

    public function __construct()
    {
        $this->parseUrl();
        $this->setControllerName();
        $this->setController();
        $this->setAction();
        $this->setParams();

        call_user_func_array([$this->controller, $this->action],  $this->params);
    }

    private function setController(): void
    {
        require_once SITE_ROOT . 'controllers/' . $this->controller_name . '.php';
        $this->controller = new $this->controller_name;
    }

    private function setControllerName(): void
    {

        if (file_exists(SITE_ROOT . 'controllers/' . ucfirst($this->url_data[0]) . 'Controller.php')) {
            $this->controller_name = ucfirst($this->url_data[0]) . 'Controller';
            unset($this->url_data[0]);
        } else {
            $this->controller_name = ucfirst(DEFAULT_CONTROLLER) . 'Controller';
        }
    }

    private function setAction(): void
    {
        if (isset($this->url_data[1]) && method_exists($this->controller, $this->url_data[1])) {
            $this->action = $this->url_data[1];
            unset($this->url_data[1]);
        }
    }

    private function setParams()
    {
        $this->params = array_values($this->url_data);
    }

    private function parseUrl(): void
    {
        $this->url_data = isset($_GET['url'])
            ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL))
            : [DEFAULT_CONTROLLER, DEFAULT_ACTION];
    }
}
