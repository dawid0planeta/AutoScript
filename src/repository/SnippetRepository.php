<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Snippet.php';

class SnippetRepository extends Repository
{
    public function getSnippet(int $id): ?Snippet{
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.snippets WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $snippet = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($snippet == false) {
            return null;
        }

        $stmt = $this->database->connect()->prepare('
            SELECT name, surname FROM public.users_details JOIN public.users u ON users_details.id = u.id_user_details WHERE u.id = :id_author;
        ');

        $stmt->bindParam(':id_author', $snippet['id_author'], PDO::PARAM_INT);
        $stmt->execute();

        $author = $stmt->fetch(PDO::FETCH_ASSOC);
        $author_name = $author['name'] . ' ' . $author['surname'];

        return new Snippet (
            $snippet['title'],
            $snippet['description'],
            $snippet['instruction'],
            $snippet['platform'],
            $snippet['snippet_filepath'],
            $author_name,
        );
    }

    public function addSnippet(Snippet $snippet): void {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.snippets (title, id_author, description, instruction, platform, snippet_filepath, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $id_author = $_SESSION['user_id'];
        $author_name = 'dawid dawid';
        $snippet->setAuthorName($author_name);
        $stmt->execute([
            $snippet->getTitle(),
            $id_author,
            $snippet->getDescription(),
            $snippet->getInstruction(),
            $snippet->getPlatform(),
            $snippet->getSnippetFile(),
            $date->format('Y-m-d')
        ]);
    }

    public function getAllSnippets(): array {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT name, surname, title, description, instruction, platform, snippet_filepath
            FROM public.snippets
            JOIN users u ON u.id = snippets.id_author
            JOIN users_details ud ON ud.id = u.id_user_details;
        ');

        $stmt->execute();

        $snippets = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach ($snippets as $snippet) {
            $author_name = $snippet['name'] . ' ' . $snippet['surname'];
            $result[] = new Snippet (
                $snippet['title'],
                $snippet['description'],
                $snippet['instruction'],
                $snippet['platform'],
                $snippet['snippet_filepath'],
                $author_name
            );
        }

        return $result;
    }

    public function getUserSnippets(): array {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT name, surname, title, description, instruction, platform, snippet_filepath
            FROM public.snippets
            JOIN users u ON u.id = snippets.id_author
            JOIN users_details ud ON ud.id = u.id_user_details
            where u.id = :id_user;
        ');

        $stmt->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);

        $stmt->execute();

        $snippets = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach ($snippets as $snippet) {
            $author_name = $snippet['name'] . ' ' . $snippet['surname'];
            $result[] = new Snippet (
                $snippet['title'],
                $snippet['description'],
                $snippet['instruction'],
                $snippet['platform'],
                $snippet['snippet_filepath'],
                $author_name
            );
        }

        return $result;
    }
}