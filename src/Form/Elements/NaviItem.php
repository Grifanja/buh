<?php

namespace App\Form\Elements;


class NaviItem
{
    private $name = 'not name';
    private $href = 'not href';

    /**
     * NaviItem constructor.
     * @param string $href
     * @param string $name
     */
    public function __construct(string $name, string $href)
    {
        $this->name = $name;
        $this->href = $href;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param mixed $href
     */
    public function setHref($href): void
    {
        $this->href = $href;
    }



}