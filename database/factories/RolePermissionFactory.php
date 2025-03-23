<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'role_id' => Role::all()->random()->id,
            'permission_id' => Permission::all()->random()->id,
        ];
    }
}
