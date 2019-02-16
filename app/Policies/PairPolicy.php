<?php

namespace App\Policies;

use App\User;
use App\Pair;
use Illuminate\Auth\Access\HandlesAuthorization;

class PairPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pair.
     *
     * @param  \App\User  $user
     * @param  \App\Pair  $pair
     * @return mixed
     */
    public function manage(User $user, Pair $pair)
    {
        return $user->owns($pair);
    }

}
