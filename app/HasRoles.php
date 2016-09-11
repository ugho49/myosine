<?php
/**
 * Created by PhpStorm.
 * User: ughostephan
 * Date: 11/09/2016
 * Time: 09:37
 */
namespace App;

use Symfony\Component\Console\Exception\LogicException;

trait HasRoles
{
    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignRole($role)
    {
        if ($this->hasRole($role)) {
            return false;
        }

        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }
    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function countRoles()
    {
        return $this->roles->count();
    }

    public function removeRole($role)
    {
        if (!$this->hasRole($role)) {
            return false;
        }

        if ($this->countRoles() > 1) {
            return $this->roles()->detach(
                Role::whereName($role)->firstOrFail()
            );
        }
    }
}