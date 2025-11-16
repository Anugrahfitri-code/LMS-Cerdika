<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;
use App\Models\Course; 
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPolicy
{
    use HandlesAuthorization;

    private function isAdminOrOwner(User $user, Course $course): bool
    {
        if ($user->role === 'admin') {
            return true;
        }
        return $user->id === $course->user_id;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Course $course): bool
    {
        return $this->isAdminOrOwner($user, $course);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Content $content): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Course $course): bool
    {
        return $this->isAdminOrOwner($user, $course);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Content $content): bool
    {
        return $this->isAdminOrOwner($user, $content->course);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Content $content): bool
    {
        return $this->isAdminOrOwner($user, $content->course);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Content $content): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Content $content): bool
    {
        return false;
    }
}
