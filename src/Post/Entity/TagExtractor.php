<?php

namespace App\Post\Entity;


interface TagExtractor
{
    /**
     * Retrieve tags from text
     *
     * @param string $text
     * @return Tag[]
     */
    public function fromText(string $text): array;
}