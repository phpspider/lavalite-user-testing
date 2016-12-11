<?php

namespace Test\Test\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Test\Test\Models\Test;

class TestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can view the test.
     *
     * @param User $user
     * @param Test $test
     *
     * @return bool
     */
    public function view(User $user, Test $test)
    {
        if ($user->canDo('test.test.view') && $user->is('admin')) {
            return true;
        }

        return $user->id === $test->user_id;
    }

    /**
     * Determine if the given user can create a test.
     *
     * @param User $user
     * @param Test $test
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('test.test.create');
    }

    /**
     * Determine if the given user can update the given test.
     *
     * @param User $user
     * @param Test $test
     *
     * @return bool
     */
    public function update(User $user, Test $test)
    {
        if ($user->canDo('test.test.update') && $user->is('admin')) {
            return true;
        }

        return $user->id === $test->user_id;
    }

    /**
     * Determine if the given user can delete the given test.
     *
     * @param User $user
     * @param Test $test
     *
     * @return bool
     */
    public function destroy(User $user, Test $test)
    {
        if ($user->canDo('test.test.delete') && $user->is('admin')) {
            return true;
        }

        return $user->id === $test->user_id;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $user    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($user, $ability)
    {
        if ($user->isSuperUser()) {
            return true;
        }
    }
}
