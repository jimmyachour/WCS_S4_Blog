<?php


namespace App\Entity;


class Article
{

    /**
     * @string
     */
    private $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $this->getReadableTitle($title);
    }

    public function getReadableTitle(string $title):string
    {
        return implode(' ', array_map('ucfirst', explode('-',$title)));
    }


}