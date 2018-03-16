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
     * @return $this
     */
    public function setDescription(string $description, TagExtractor $tagExtractor)
    {
        $this->description = $description;
        $this->tags = $tagExtractor->fromText($description);

        return $this;
    }
    /**
     * @param FileReference $media
     * @return $this
     */
    public function setMedia(FileReference $media)
    {
        $this->media = $media;

        return $this;
    }
    /**
     * @param Author $author
     * @return $this
     */
    public function setAuthor(Author $author)
    {
        $this->author = $author;

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