<?php
namespace Bar;

class Bar
{
    private $id;
    private $name;
    private $address;
    private $keywords=array();

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function addKeyword(string $keyword)
    {
        $this->keywords[] = $keyword;
    }

    public function addKeywords(array $keywords)
    {
        array_push($this->keywords, ...$keywords);
    }
}
