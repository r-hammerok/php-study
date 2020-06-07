<?php
include "src/TariffInterface.php";
include "src/ServiceInterface.php";
include "src/TariffAbstract.php";
include "src/TariffBasic.php";
include "src/TariffHour.php";
include "src/TariffStudent.php";
include "src/ServiceGPS.php";
include "src/ServiceDriver.php";

$tariff = new TariffStudent(10, 60);
$tariff->addService(new ServiceGPS(1, 15));
$tariff->addService(new ServiceGPS(1, 15));
//$tariff->addService(new ServiceDriver(2, 100));
//$tariff->addService(new ServiceDriver(3, 200));
echo $tariff->getTripPrice();