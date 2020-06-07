<?php
interface TariffInterface {
    public function getTripPrice();
    public function addService(ServiceInterface $service);
    public function getMinutes();
    public function getDistance();
}
