<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Snippet.php';
require_once __DIR__.'/../repository/SnippetRepository.php';

class SnippetController extends AppController {
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['text/plain'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $snippetRepository;

    private $messages = [];

    public function __construct() {
        parent::__construct();
        $this->snippetRepository = new SnippetRepository();
    }

    public function catalog() {
        $snippets = $this->snippetRepository->getAllSnippets();
        $this->render('catalog', ['snippets' => $snippets]);
    }


    public function add_snippet() {
        if (!isset($_SESSION['user_id']))
        {
            $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: $url/login");
            die();
        }
        if ($this->isPost() && is_uploaded_file($_FILES['snippet_file']['tmp_name']) && $this->validate($_FILES['snippet_file'])) {
            move_uploaded_file(
                $_FILES['snippet_file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['snippet_file']['name']
            );


            $snippet = new snippet(
                $_POST['title'],
                $_POST['description'],
                $_POST['instruction'],
                $_POST['platform'],
                $_FILES['snippet_file']['name'],
                ''
            );

            $this->snippetRepository->addSnippet($snippet);


            return $this->render('my_snippets', [
                'messages' => $this->messages]);
        }
        return $this->render('add_snippet', ['messages' => $this->messages]);

    }

    public function my_snippets() {
        if (!isset($_SESSION['user_id']))
        {
            $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: $url/login");
            die();
        }
        $snippets = $this->snippetRepository->getUserSnippets($_SESSION['user_id']);
        $this->render('my_snippets', ['snippets' => $snippets]);
    }

    private function validate(array $file): bool {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
           $this->messages[] = 'File type not supported';
           return false;
        }

        return true;
    }
}