<?php
class JokeController {
	private $authorsTable;
    private $jokesTable;
    
	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable) {
		$this->jokesTable = $jokesTable;
		$this->authorsTable = $authorsTable;
	}
	public function list() {
		$result = $this->jokesTable->findAll();
		$jokes = [];
		foreach ($result as $joke) {
			$author = $this->authorsTable->findById($joke['authorid']);
			$jokes[] = [
				'id' => $joke['id'],
				'joketext' => $joke['joketext'],
				'jokedate' => $joke['jokedate'],
				'name' => $author['name'],
				'email' => $author['email']
			];
		}
		$title = 'Joke list';
		$totalJokes = $this->jokesTable->total();
        return ['template' => 'jokes.php',
                'title' => $title,
                'variables' => [
                    'totalJokes' => $totalJokes,
                    'jokes' => $jokes
                    ] 
                ];
    	}
	public function home() {
		$title = 'Internet Joke Database';
		return ['template' => 'home.php', 'title' => $title];
    }
	public function delete() {
		$this->jokesTable->delete($_POST['id']);
		header('location: /joke/list'); 
	}
	public function edit() {
		if (isset($_POST['joke'])) {
			$joke = $_POST['joke'];
			$joke['jokedate'] = new DateTime();
			$joke['authorid'] = 1;
			$this->jokesTable->save($joke);
			
			header('location: /joke/list'); 
		}
		else {
			if (isset($_GET['id'])) {
				$joke = $this->jokesTable->findById($_GET['id']);
			}
			$title = 'Edit joke';
            return [
				'template' => 'editjokelayout.php',
                'title' => $title,
				'variables' => ['joke' => $joke ?? null] 
            ];		
        }
	}
}