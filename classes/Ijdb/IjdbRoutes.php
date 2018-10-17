<?php
namespace Ijdb;

class IjdbRoutes{
    public function getRoutes(){
      
        include __DIR__ . '/../../includes/DatabaseConnection.php';
        
        $jokesTable = new \Framework\DatabaseTable($pdo, 'jokes', 'id');
        $authorsTable = new \Framework\DatabaseTable($pdo, 'author', 'id');

        $jokeController = new \Ijdb\Controllers\Ijdb\Controllers\JokeController($jokesTable,$authorsTable);
        // OLD WAY    
                // if ($route === 'joke/list') {
                //     $controller = new \Ijdb\Controllers\JokeController($jokesTable, $authorsTable);
                //     $page = $controller->list();
                // }
                // else if ($route === '') {
                //     $controller = new \Ijdb\Controllers\JokeController ($jokesTable, $authorsTable);
                //     $page = $controller -> home();
                // }
                // else if ($route === 'joke/edit') {
                //     $controller = new \Ijdb\Controllers\JokeController($jokesTable, $authorsTable);
                //     $page = $controller->edit();
                // }
                // else if ($route === 'joke/delete') {
                //     $controller = new \Ijdb\Controllers\JokeController($jokesTable, $authorsTable);
                //     $page = $controller->delete();
                // }
                // else if ($route === 'register') {
                //     $controller = new \Ijdb\Controllers\RegisterController($authorsTable);
                //     $page = $controller->showForm();}
                
                //     return $page;
        // NEW WAY => ROUTES ARRAY FOR THE JOKES AND CODE SELECTING RELEVANT ROUTE
                $routes = [

                    'joke/edit' => [
                        'POST' => [
                            'controller' => $JokeController,
                            'action'=> 'saveEdit',
                        ],
                        'GET' => [
                            'controller' => $JokeController,
                            'action'=> 'edit',
                        ],
                    ],
                    'joke/delete' => [
                        'POST' => [
                            'controller' => $JokeController,
                            'action'=> 'delete',
                        ],
                    ],
                    '' => [
                        'GET' => [
                            'controller' => $JokeController,
                            'action'=> 'home',
                        ],
                    ],
                   ' joke/list' => [
                        'GET' => [
                            'controller' => $JokeController,
                            'action'=> 'list',
                        ],
                    ],

                ];
                
            return $routes;
        
    }
}