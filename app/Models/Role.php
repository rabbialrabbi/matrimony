<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Many-To-Many Relationship Method for accessing the Role->permissions
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    /**
     * Assign permission to certain roles
     */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->syncWithoutDetaching($permission);
    }
}
