<?php
abstract class TariffAbstract implements TariffInterface
{
    protected $pricePerKilometr;
    protected $pricePerMinute;
    protected $distance;
    protected $minutes;
    /** @var ServiceInterface[] */
    protected $services = [];

    public function __construct($distance, $minutes)
    {
        $this->distance = $distance;
        $this->minutes = $minutes;
    }

    public function getTripPrice()
    {
        $price = $this->distance * $this->pricePerKilometr + $this->minutes * $this->pricePerMinute;

        if ($this->services) {
            foreach ($this->services as $service) {
                $service->apply($this, $price);
            }
        }

        return $price;
    }

    public function addService(ServiceInterface $service)
    {
        $found = false;
        foreach ($this->services as $serv) {
            if ($serv->getId() == $service->getId()) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            array_push($this->services, $service);
        }
        return $this;
    }

    public function removeService($id)
    {
        foreach ($this->services as $key=>$serv) {
            if ($serv->getId() === $id) {
                unset($this->services[$key]);
                break;
            }
        }

        return $this;
    }

    public function getMinutes()
    {
        return $this->pricePerMinute;
    }

    public function getDistance()
    {
        return $this->pricePerKilometr;
    }
}