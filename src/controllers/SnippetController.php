<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Snippet.php';

class SnippetController extends AppController {
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['text/plain'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    public function add_snippet() {
        echo exec('whoami');
        if ($this->isPost()) {
            var_dump($_FILES);
        }
        if ($this->isPost() && is_uploaded_file($_FILES['snippet_file']['tmp_name']) && $this->validate($_FILES['snippet_file'])) {
            echo "here";
            move_uploaded_file(
                $_FILES['snippet_file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['snippet_file']['name']
            );

            $snippet = new snippet(
                $_POST['title'],
                $_POST['description'],
                $_POST['instruction'],
                $_POST['platform'],
                $_FILES['snippet_file']['name']
            );

            return var_dump($snippet);
            //return $this->render('my_snippets', ['messages' => $this->messages]);
        }
        return $this->render('add_snippet', ['messages' => $this->messages]);

    }

    public function my_snippets() {
        return $this->render('my_snippets');
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