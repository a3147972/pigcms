<?php

class DeliveryAddressInfo
{
    public $address;
    public $mobilePhone;
    public $name;
    public $telPhone;
    public $zipCode;

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getTelPhone()
    {
        return $this->telPhone;
    }

    public function setTelPhone($telPhone)
    {
        $this->telPhone = $telPhone;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }
}


?>
