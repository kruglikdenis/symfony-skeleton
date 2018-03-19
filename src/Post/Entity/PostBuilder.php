<?php

namespace App\Post\Entity;


use App\Upload\FileReference;

class PostBuilder
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var FileReference
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
     * @param FileReference $media
     *
     * @return PostBuilder
     */
    public function setMedia(FileReference $media): self
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
     * @return FileReference
     */
    public function media(): FileReference
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