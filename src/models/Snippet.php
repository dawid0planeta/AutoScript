<?php

class Snippet
{
    private $title;
    private $description;
    private $instruction;
    private $platform;
    private $snippet_file;
    private $author_name;
    private $id;


    public function __construct(string $title, string $description, string $instruction, string $platform, string $snippet_file, string $author_name, int $id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->instruction = $instruction;
        $this->platform = $platform;
        $this->snippet_file = $snippet_file;
        $this->author_name = $author_name;
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getInstruction(): string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction)
    {
        $this->instruction = $instruction;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform)
    {
        $this->platform = $platform;
    }

    public function getSnippetFile(): string
    {
        return $this->snippet_file;
    }

    public function setSnippetFile(string $snippet_file)
    {
        $this->snippet_file = $snippet_file;
    }

    public function getAuthorName(): string
    {
        return $this->author_name;
    }

    public function setAuthorName(string $author_name)
    {
        $this->author_name = $author_name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}