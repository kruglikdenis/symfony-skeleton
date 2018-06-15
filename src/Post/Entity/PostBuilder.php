<?php

namespace App\Post\Entity;


class PostBuilder
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Media
     */
    private $media;

    /**
     * @var User
     */
    private $author;

    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * Build post
     *
     * @return Post
     */
    public function build(): Post
    {
        return new Post($this);
    }

    /**
     * @param string $title
     *
     * @return PostBuilder
     */
    public function withTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $description
     * @param TagExtractor $tagExtractor
     *
     * @return PostBuilder
     */
    public function setDescription(string $description, TagExtractor $tagExtractor): self
    {
        $this->description = $description;
        $this->tags = $tagExtractor->fromText($description);

        return $this;
    }

    /**
     * @param string $id
     *
     * @return PostBuilder
     */
    public function setMedia(string $id): self
    {
        $this->media = new Media($id);

        return $this;
    }

    /**
     * @param string $id
     *
     * @return PostBuilder
     */
    public function setAuthor(string $id): self
    {
        $this->author = new User($id);

        return $this;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return Media
     */
    public function media(): ?Media
    {
        return $this->media;
    }

    /**
     * @return User
     */
    public function author(): User
    {
        return $this->author;
    }

    /**
     * @return array
     */
    public function tags(): array
    {
        return $this->tags;
    }
}