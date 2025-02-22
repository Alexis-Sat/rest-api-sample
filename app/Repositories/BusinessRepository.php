<?php

namespace App\Repositories;

use App\Interfaces\BusinessRepositoryInterface;
use App\Models\Business;
use App\Models\Organization;

class BusinessRepository implements BusinessRepositoryInterface
{

    public function findByBusiness($name)
    {
        $business = Business::with('children')->where('name', 'like', '%' . $name . '%')->select(['id', 'parent_id'])->get();
        $ids = $this->collapsIds($business);
        $organizations = Organization::whereHas('business', function ($query) use ($ids) {
            $query->whereIn('id', $ids);
        })->get();

        return $organizations;
    }

    //Соберем ид для всех дочерних видов бизнеса
    private function collapsIds($data)
    {
        $parent = $data->pluck('id')->toArray();
        $children = $data->pluck('children')->flatten();
        $childs = $children->pluck('childs')->flatten()->pluck('id')->toArray();
        $childrenIds = $children->pluck('id')->toArray();

        return array_merge($parent, $childs, $childrenIds);
    }

}
