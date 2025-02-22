<?php

namespace App\Repositories;
use App\Interfaces\BuildingRepositoryInterface;
use App\Models\Building;

class BuildingRepository implements BuildingRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function findByCoordinates($latitude, $longitude, $distance)
    {
        return Building::with('organization')->gpsDistance($latitude, $longitude,$distance)->get();
    }

    public function findByBuilding($id)
    {
        return Building::with('organization')->whereId($id)->get();
    }

    public function findByAddress($address)
    {
        return Building::with('organization')->where('address', 'like', '%' . $address . '%')->get();
    }
}
