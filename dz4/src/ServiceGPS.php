<?php
class ServiceGPS implements ServiceInterface
{
    private $pricePerHour;
    private $id;

    public function __construct($id, $pricePerHour)
    {
        $this->id = $id;
        $this->pricePerHour = $pricePerHour;
    }

    public function apply(TariffInterface $tariff, &$price)
    {
        $hours = ceil($tariff->getMinutes() / 60);
        $price += $this->pricePerHour * $hours;
    }

    public function getId()
    {
        return $this->id;
    }
}