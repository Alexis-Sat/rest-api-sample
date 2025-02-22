<?php

namespace App\Interfaces;

interface BuildingRepositoryInterface
{
    public function findByCoordinates($latitude, $longitude, $distance);
    public function findByBuilding($id);
    public function findByAddress($address);
}
