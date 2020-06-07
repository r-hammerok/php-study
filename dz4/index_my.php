<?php

abstract class Rates
{
    const PRICE_KM = 0;
    const PRICE_MIN = 0;
    const MINUTE_IN_HOUR = 60;
    const PRICE_GPRS_PER_HOUR = 15;
    const PRICE_DRIVER_PER_HOUR = 100;
    protected $distance = 0;
    protected $duration = 0;
    protected $includeAdditionalDriver = false;
    protected $includeGPRS = false;

    public function __construct($distance, $duration)
    {
        $this->distance = $distance;
        $this->duration = $duration;
    }

    public function getTripPrice()
    {
        $add = 0;
        if ($this->includeGPRS) {
            $hour = $this->duration <= self::MINUTE_IN_HOUR ? 1 : ceil($this->duration / self::MINUTE_IN_HOUR);
            $add += $hour * self::PRICE_GPRS_PER_HOUR;
        }
        if ($this->includeAdditionalDriver) {
            $add += self::PRICE_DRIVER_PER_HOUR;
        }
        return $add + $this->distance * static::PRICE_KM + $this->duration * static::PRICE_MIN;
    }

    public function addAditionalDriver()
    {
        $this->includeAdditionalDriver = true;
    }

    public function removeAditionalDriver()
    {
        $this->includeAdditionalDriver = false;
    }

    public function addGPRS()
    {
        $this->includeGPRS = true;
    }

    public function removeGPRS()
    {
        $this->includeGPRS = false;
    }

    public function addAllServices()
    {
        $this->removeGPRS();
        $this->removeAditionalDriver();
    }

    public function removeAllServices()
    {
        $this->addGPRS();
        $this->addAditionalDriver();
    }
}

class BaseRate extends Rates
{
    const PRICE_KM = 10;
    const PRICE_MIN = 3;

}

class HourlyRate extends Rates
{
    const PRICE_MIN = 200;

    public function __construct($distance, $duration)
    {
        parent::__construct($distance, $duration);
        $this->duration = ceil($duration / 60);
    }
}

class StudentRate extends Rates
{
    const PRICE_KM = 4;
    const PRICE_MIN = 1;
}

$tarif1 = new BaseRate(10, 90);
$tarif2 = new HourlyRate(10, 179);
$tarif3 = new StudentRate(10, 100);

echo "Стоимость без GPRS и без водителя<br>";
echo $tarif1->getTripPrice();
echo "<br />";
echo $tarif2->getTripPrice();
echo "<br />";
echo $tarif3->getTripPrice();
echo "<br />";
echo "<br />";

echo "Стоимость с GPRS без водителя<br>";
$tarif1->addGPRS();
echo $tarif1->getTripPrice();
$tarif1->removeGPRS();
echo "<br />";
$tarif2->addGPRS();
echo $tarif2->getTripPrice();
$tarif2->removeGPRS();
echo "<br />";
$tarif3->addGPRS();
echo $tarif3->getTripPrice();
$tarif3->removeGPRS();
echo "<br />";
echo "<br />";

echo "Стоимость с водителем без GPRS<br>";
$tarif1->addAditionalDriver();
echo $tarif1->getTripPrice();
$tarif1->removeAditionalDriver();
echo "<br />";
$tarif2->addAditionalDriver();
echo $tarif2->getTripPrice();
$tarif2->removeAditionalDriver();
echo "<br />";
$tarif3->addAditionalDriver();
echo $tarif3->getTripPrice();
$tarif3->removeAditionalDriver();
echo "<br />";
echo "<br />";

echo "Стоимость с водителем и GPRS<br>";
$tarif1->addAllServices();
echo $tarif1->getTripPrice();
$tarif1->removeAllServices();
echo "<br />";
$tarif2->addAllServices();
echo $tarif2->getTripPrice();
$tarif2->removeAllServices();
echo "<br />";
$tarif3->addAllServices();
echo $tarif3->getTripPrice();
$tarif3->removeAllServices();
echo "<br />";
echo "<br />";

echo "Стоимость с дважды водителем<br>";
$tarif1->addAditionalDriver();
$tarif1->addAditionalDriver();
echo $tarif1->getTripPrice();
echo "<br />";
$tarif2->addAditionalDriver();
$tarif2->addAditionalDriver();
echo $tarif2->getTripPrice();
echo "<br />";
$tarif3->addAditionalDriver();
$tarif3->addAditionalDriver();
echo $tarif3->getTripPrice();
$tarif1->removeAllServices();
$tarif2->removeAllServices();
$tarif3->removeAllServices();
echo "<br />";
echo "<br />";

echo "Стоимость с дважды GPRS<br>";
$tarif1->addGPRS();
$tarif1->addGPRS();
echo $tarif1->getTripPrice();
echo "<br />";
$tarif2->addGPRS();
$tarif2->addGPRS();
echo $tarif2->getTripPrice();
echo "<br />";
$tarif3->addGPRS();
$tarif3->addGPRS();
echo $tarif3->getTripPrice();
echo "<br />";
$tarif1->removeAllServices();
$tarif2->removeAllServices();
$tarif3->removeAllServices();
