<?php
class App
{
    protected $controller = "AuthController";
    protected $method = "loginForm";
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        require_once "../routes/web.php";

        if(empty($url) && isset($routes[""])) {
            $this->controller = $routes[""]["controller"];
            $this->method = $routes[""]["method"];
        }

        if(isset($url[0]) && isset($routes[$url[0]])) {
            $this->controller = $routes[$url[0]]["controller"];
            $this->method = $routes[$url[0]]["method"];
            $url = [];
        } else if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if(file_exists("../app/controllers/$controllerName.php")) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        require_once "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller();

        if(isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return [];
    }
}
?>