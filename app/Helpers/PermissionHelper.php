<?php

namespace App\Helpers;

use App\Models\User;

class PermissionHelper
{
    /**
     * Check if a user can access a feature by its name.
     *
     * @param User $user
     * @param string $featureName
     * @return bool
     */
    public static function userCanAccessFeature(User $user, string $featureName, string $permissionName,): bool
    {
        // return $user->role->permissions->filter(function ($permission) use ($permissionName, $featureName) {
        //     return $permission->name === $permissionName && $permission->feature->where('name', $featureName);
        // })->isNotEmpty();
        if (!$user) {
            return false;
        }

        return $user->role->permissions()
            ->whereHas('feature', function ($query) use ($featureName) {
                $query->where('name', $featureName);
            })
            ->where('name', $permissionName)
            ->exists();
    }
}
