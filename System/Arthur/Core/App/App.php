<?php
namespace Arthur\Core\App;
/**
 * @author Adam Arthur Faizal
 *
 **/

class App {
    /**
     * @var mixed|string
     */
    protected $controller = 'HomeController';

    /**
     * @var string
     */
    protected string $method = 'index';

    /**
     * @var array
     */
    protected array $params = [];

    /**
     * App constructor.
     */
    public function __construct(){
        $url = $this->parseUrl();

        // Controller
        if (isset($url[0]) && file_exists("App/Controllers/{$url[0]}Controller.php")):
            $this->controller = "{$url[0]}Controller";
            unset($url[0]);
        endif;
        require_once "App/Controllers/{$this->controller}.php";
        $this->controller = new $this->controller();

        // Method
        if (isset($url[1]) && method_exists($this->controller, $url[1])):
            $this->method = $url[1];
            unset($url[1]);
        endif;

        // Parameter
        if (!empty($url)):
            $this->params = array_values($url);
        endif;

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * @return array
     */
    public function parseUrl(): array
    {
        if (isset($_GET['url'])):
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        endif;
        return [];
    }
}