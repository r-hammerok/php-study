<?php
class ServiceDriver implements ServiceInterface
{
    private $price;
    private $id;

    public function __construct($id, $price)
    {
        $this->id = $id;
        $this->price = $price;
    }

    public function apply(TariffInterface $tariff, &$price)
    {
        $price += $this->price;
    }

    public function getId()
    {
        return $this->id;
    }
}