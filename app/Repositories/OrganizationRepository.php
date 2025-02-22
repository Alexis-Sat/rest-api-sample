<?php

namespace App\Repositories;

use App\Interfaces\OrganizationRepositoryInterface;
use App\Models\Organization;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    public function findById($id)
    {
        return Organization::with('building')->whereId($id)->get();
    }

    public function findByName($name)
    {
        return Organization::with( 'building')->where('name', 'like', '%'.  strtolower($name).'%')->get();
    }

}
