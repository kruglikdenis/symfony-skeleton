<?php

namespace App\Post\Entity;



class PostBuilder
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var
     */
    private $media;

    /**
     * @var Author
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
     * @param  $media
     *
     * @return PostBuilder
     */
    public function setMedia( $media): self
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @param string $id
     *
     * @return PostBuilder
     */
    public function setAuthor(string $id): self
    {
        $this->author = new Author($id);

        return $this;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return
     */
    public function media()
    {
        return $this->media;
    }

    /**
     * @return Author
     */
    public function author(): Author
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