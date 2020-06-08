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
        if (!in_array($service->getId(), $this->getListServices(), true)) {
            array_push($this->services, $service);
        }

        return $this;
    }

    public function removeService($id)
    {
        $key = array_search($id, $this->getListServices(), true);
        if (!$key === false) {
            unset($this->services[$key]);
        };
        return $this;
    }

    public function getListServices()
    {
        $ret = [];
        foreach ($this->services as $key => $serv) {
            $ret[] = $serv->getId();
        }
        return $ret;
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
