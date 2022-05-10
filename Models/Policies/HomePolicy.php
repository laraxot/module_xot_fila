<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Policies;

use Modules\Xot\Contracts\UserContract;

/**
 * Class HomePolicy.
 */
class HomePolicy extends XotBasePolicy {
    public function index(?UserContract $user, \Illuminate\Database\Eloquent\Model $post): bool {
        return true; // da aggiungere pezzi
    }

    public function show(?UserContract $user, \Illuminate\Database\Eloquent\Model $post): bool {
        return true; // da aggiungere pezzi
    }
}
