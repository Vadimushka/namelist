<?php

namespace vadimushka_d\NameList;

class Name
{

    public function __construct(protected string $name, protected string $last, protected bool $isFemale = false)
    {
        if ($this->isFemale) {
            $this->last = preg_replace("/^(.+)(ов|ев|ёв|ин|ын)$/", "$1$2а", $this->last);
            $this->last = preg_replace("/^(.+)(ый|ий)$/", "$1ая", $this->last);
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLast(): string
    {
        return $this->last;
    }

    public function getFull(): string
    {
        return $this->name . ' ' . $this->last;
    }

    public function __toString(): string
    {
        return $this->getFull();
    }

}