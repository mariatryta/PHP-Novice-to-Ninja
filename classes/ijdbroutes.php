<?php
class IjdbRoutes{
    public function callAction($route){
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';
    
        $jokesTable = new DatabaseTable($pdo, 'jokes', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');
        
                if ($route === 'joke/list') {
                    include __DIR__ . '/../controllers/JokeController.php';
                    $controller = new JokeController($jokesTable, $authorsTable);
                    $page = $controller->list();
                }
                else if ($route === '') {
                    include __DIR__ . '/../controllers/JokeController.php';
                    $controller = new JokeController($jokesTable, $authorsTable);
                    $page = $controller -> home();
                }
                else if ($route === 'joke/edit') {
                    include __DIR__ . '/../controllers/JokeController.php';
                    $controller = new JokeController($jokesTable, $authorsTable);
                    $page = $controller->edit();
                }
                else if ($route === 'joke/delete') {
                    include __DIR__ . '/../controllers/JokeController.php';
                    $controller = new JokeController($jokesTable, $authorsTable);
                    $page = $controller->delete();
                }
                else if ($route === 'register') {
                    include __DIR__ . '/../controllers/RegisterController.php';
                    $controller = new RegisterController($authorsTable);
                    $page = $controller->showForm();}
                
                    return $page;
    }
}