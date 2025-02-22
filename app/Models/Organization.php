<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @OA\Schema(
 *   schema="FullOrgInfo",
 *   allOf={
 *      @OA\Schema(ref="#/components/schemas/Organization"),
 *      @OA\Schema(
 *         @OA\Property(property="building", type="array", @OA\Items(ref="#/components/schemas/Building")
 *      )
 *      )
 *  }
 *      )
 *
 * @OA\Schema(
 * @OA\Xml(name="Organization"),
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", description="Organization name"),
 * @OA\Property(property="phone", type="string",  description="Organization phones", example="main:+797879888"),
 * @OA\Property(property="building_id", type="integer", example="1"),
 * )
 *
 * Class Organization
 *
 */
class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory, SoftDeletes;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function business()
    {
        return $this->belongsToMany(Business::class)->withTimestamps();
    }


}
