<?php

namespace YottaHQ\LaravelExtendedAuth\Drivers;

use Closure;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Support\Arrayable;
use YottaHQ\LaravelExtendedAuth\Models\UserEmailAddress;

class ExtendedUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        $credentials = array_filter(
            $credentials,
            static fn ($key) => ! str_contains($key, 'password'),
            ARRAY_FILTER_USE_KEY
        );

        if (empty($credentials)) {
            return;
        }

        $authenticateByAnyEmail = config('laravel-extended-auth.authenticate_by_any_email', false);

        $userFromUsersTable = $this->getUserByEmailFromUsersTable($credentials);

        if (!$userFromUsersTable && $authenticateByAnyEmail) {
            return $this->getUserBySecondaryEmailAddress($credentials);
        }

        return $userFromUsersTable;
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }

    private function getUserByEmailFromUsersTable(array $credentials)
    {
        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } elseif ($value instanceof Closure) {
                $value($query);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    private function getUserBySecondaryEmailAddress(array $credentials)
    {
        $query = (new UserEmailAddress())->newQuery();

        foreach ($credentials as $key => $value) {
            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } elseif ($value instanceof Closure) {
                $value($query);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first()?->user;
    }
}
