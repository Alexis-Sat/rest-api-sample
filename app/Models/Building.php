<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Business"),
 * @OA\Property(property="id", type="integer", example="100"),
 * @OA\Property(property="address", type="string",  description="Building address"),
 * @OA\Property(property="address_latitude", type="number", example="100"),
 * @OA\Property(property="address_longitude", type="number", example="10000"),
 * )
 *
 * Class Organization
 *
 */
class Building extends Model
{
    /** @use HasFactory<\Database\Factories\BuildingFactory> */
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function organization()
    {
        return $this->hasMany(Organization::class);
    }

    public function scopeGpsDistance($query,$from_latitude,$from_longitude,$distance)
    {
        //Сферическая теорема косинусов - т.к. уравнение для плоскости не подойдет
        // в милях нужно умножить на радиус Земли ( 3959 для милей или 6371 для км)
        $subQuery = DB::raw("round((6371 * acos(cos(radians($from_latitude)) * cos(radians(address_latitude)) * cos(radians(address_longitude) - radians($from_longitude)) + sin(radians($from_latitude)) * sin(radians(address_latitude))))) as gps_distance");
        return $query->select('*')->addSelect($subQuery)->groupBy('gps_distance')->having('gps_distance', '<=', $distance)->orderBy( 'gps_distance', 'ASC' );
    }

}
