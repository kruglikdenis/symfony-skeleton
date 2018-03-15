<?php

namespace App\Post\Service;

use App\Post\Entity\Tag;
use App\Post\Entity\TagExtractor;

class TextTagExtractor implements TagExtractor
{
    /**
     * @inheritdoc
     */
    public function fromText(string $text): array
    {
        preg_match_all('/\#(\w+)/', $text, $matches);

        $tags = array_map(function (string $tag) {
            return new Tag($tag);
        }, $matches[1]);

        return array_unique($tags);
    }
}