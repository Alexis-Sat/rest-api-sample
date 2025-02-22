<?php

namespace App\Interfaces;

interface OrganizationRepositoryInterface
{
    public function findById($id);
    public function findByName($name);
}
