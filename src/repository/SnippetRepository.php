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
            $snippet['id']
        );
    }

    public function addSnippet(Snippet $snippet): void {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.snippets (title, id_author, description, instruction, platform, snippet_filepath, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $id_author = $_SESSION['user_id'];
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

    public function deleteSnippet(int $id): void {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.snippets WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getAllSnippets(): array {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT s.id, name, surname, title, description, instruction, platform, snippet_filepath
            FROM public.snippets s
            JOIN users u ON u.id = s.id_author
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
                $snippet['name'] . ' ' . $snippet['surname'],
                $snippet['id']
            );
        }

        return $result;
    }

    public function getUserSnippets(): array {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT s.id, name, surname, title, description, instruction, platform, snippet_filepath
            FROM public.snippets s
            JOIN users u ON u.id = s.id_author
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
                $author_name,
                $snippet['id']
            );
        }

        return $result;
    }

    public function searchForSnippets(string $searchString) {
        $searchString = '%' . strtolower($searchString) . '%';
        $stmt = $this->database->connect()->prepare('
            SELECT s.id, name, surname, title, description, instruction, platform, snippet_filepath
            FROM public.snippets s
            JOIN users u ON u.id = s.id_author
            JOIN users_details ud ON ud.id = u.id_user_details
            where lower(title) like :searchString or lower(description) like :searchString or lower(platform) like :searchString;
        ');

        $stmt->bindParam(':searchString', $searchString, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchForUserSnippets(string $searchString) {
        $searchString = '%' . strtolower($searchString) . '%';
        $stmt = $this->database->connect()->prepare('
            SELECT s.id, name, surname, title, description, instruction, platform, snippet_filepath
            FROM public.snippets s
            JOIN users u ON u.id = s.id_author
            JOIN users_details ud ON ud.id = u.id_user_details
            where u.id = :id_user and (lower(title) like :searchString or lower(description) like :searchString or lower(platform) like :searchString);
        ');

        $stmt->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':searchString', $searchString, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAuthorId(Snippet $snippet): int {
        $stmt = $this->database->connect()->prepare('
            SELECT id_author FROM public.snippets WHERE id = :id_snippet;
        ');

        $stmt->bindParam(':id_snippet', $snippet->getId(), PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_author'];
    }
}