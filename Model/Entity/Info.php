<?php

namespace App\Model\Entity;

class Info extends AbstractEntity
{
    private string $content;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Info
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

}