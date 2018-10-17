<?php
namespace Framework;

class EntryPoint{
    private $route;
    private $routes;
    private $method;

    public function __construct($route, $method, $routes){
        $this -> route = $route;
        $this -> routes = $routes;
        $this -> method = $method;
        $this -> checkUrl();
    }

    // convert url to lowercase if input is in capitalized letters
    private function checkUrl(){
        if ($this -> route !== strtolower($this->route)) {
            http_response_code(301);
            header('location:'. strtolower($this->route));
        }
    }

    // loads template according to routes
    private function loadTemplate($templateFileName, $variables = []) {
        extract($variables);
        ob_start();
        include  __DIR__ . '/../../templates/' . $templateFileName;
        return ob_get_clean();
    }

    // run function for loading templates and callAction function
     public function run() {
        $routes = $this -> routes -> getRoutes();
        
        $controller = $routes[$this->route][$this->method]['controller'];
        
        $action = $routes[$this->route][$this->method]['action'];
        
        $page = $controller->$action(); 
        $title = $page['title'];
        
        if (isset($page['variables'])) {
            $output =$this-> loadTemplate($page['template'], $page['variables']);
        }
        else {
            $output =$this-> loadTemplate($page['template']);
        }
        include  __DIR__ . '/../../templates/layout.php';
    }
}

