<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *  schema="Address",
 *  allOf={
 *     @OA\Schema(ref="#/components/schemas/Business"),
 *     @OA\Schema(
 *        @OA\Property(property="organizations", type="array", @OA\Items(ref="#/components/schemas/Organization")
 *     )
 *     )
 * }
 *     )
 *
 * @OA\Schema(
 * @OA\Xml(name="Business"),
 * @OA\Property(property="id", type="integer",  example="1"),
 * @OA\Property(property="name", type="string", description="Business name"),
 * @OA\Property(property="parent_id", type="integer", example="1"),
 * )
 *
 * Class Business
 *
 */

class Business extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessFactory> */
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function organization()
    {
        return $this->belongsToMany(Organization::class);
    }


    public function childs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @psalm-suppress InvalidReturnStatement
     * @psalm-suppress InvalidReturnType
     */

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->with('childs' );
    }


    public function getAllChildActivities($activityId)
    {
        $activities = $this->newQuery()->where('parent_id', $activityId)->get();
        $allActivities = $activities->pluck('id')->toArray();

        foreach ($activities as $activity) {
            $allActivities = array_merge($allActivities, $this->getAllChildActivities($activity->id));
        }

        return $allActivities;
    }


}
