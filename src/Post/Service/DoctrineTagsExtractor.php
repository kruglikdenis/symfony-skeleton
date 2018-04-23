<?php

namespace App\Post\Service;


use App\Post\Entity\TagExtractor;

class DoctrineTagsExtractor implements TagExtractor
{
    /**
     * @var TagExtractor
     */
    private $next;

    public function __construct(TagExtractor $next)
    {
        $this->next = $next;
    }

    /**
     * @inheritdoc
     */
    public function fromText(string $text): array
    {
        $tags = $this->next->fromText($text);

        return $tags;
    }
}