<?php
namespace Arthur\Core\App;

use RuntimeException;
/**
 * @author Adam Arthur Faizal
 *
 **/

abstract class Controller {
    /**
     * @var string
     */
    protected string $className;

    /**
     * Controller constructor.
     */
    public function __construct(){
        if (isset($_SERVER['REDIRECT_URL'])):
            $this->className = explode('/', $_SERVER['REDIRECT_URL'])[2];
            if (!file_exists("App/Controllers/{$this->className}Controller.php")):
                $this->className = 'Home';
            endif;
        else: $this->className = 'Home';
        endif;
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this|object
     * @throws RuntimeException
     */
    public function __call($name, $arguments): object
    {
        if ($name === 'model') {
            switch (count($arguments)) {
                case 0:
                    require_once "App/Models/{$this->className}Model.php";
                    $model = "{$this->className}Model";
                    return new $model();
                case 1:
                    require_once "App/Models/{$arguments[0]}Model.php";
                    $model = "{$arguments[0]}Model";
                    return new $model($arguments[0]);
                default:
                    throw new RuntimeException('Unexpected value');
            }
        } else {
            throw new RuntimeException('Unexpected value');
        }
    }

    /**
     * @return mixed
     */
    public function index()
    {
        
    }

    /**
     * @param string $view
     * @param array $data
     */
    public function view(string $view, array $data = []): void
    {
        require_once "App/Views/Templates/header.php";
        require_once "App/Views/{$this->className}/{$view}.php";
        require_once "App/Views/Templates/footer.php";
    }

    /**
     * @param string $url
     * @return void
     */
    public function redirect(string $url): void
    {
        header('Location: ' . BASE_URL . $url);
        exit(0);
    }

    /**
     * @return mixed
     */
    public function show()
    {

    }

    /**
     * @return mixed
     */
    public function insert()
    {

    }

    /**
     * @return mixed
     */
    public function update()
    {

    }

    /**
     * @return mixed
     */
    public function delete()
    {

    }
}