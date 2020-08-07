<?php
namespace Core\App;

class App {
    protected $controller = 'HomeController';
    protected string $method = 'index';
    protected array $params = [];

    /**
     * App constructor.
     */
    public function __construct(){
        $url = $this->parseUrl();
        if (isset($url[0]) and file_exists("App/Controllers/{$url[0]}Controller.php")):
            $this->controller = "{$url[0]}Controller";
            unset($url[0]);
        endif;
        require_once "App/Controllers/{$this->controller}.php";
        $this->controller = new $this->controller();
        if (isset($url[1]) and method_exists($this->controller, $url[1])):
            $this->method = $url[1];
            unset($url[1]);
        endif;
        if (!empty($url)):
            $this->params = array_values($url);
        endif;
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * @return array
     */
    public function parseUrl(): array {
        if (isset($_GET['url'])):
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        endif;
        return [];
    }
}