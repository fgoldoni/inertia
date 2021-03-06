<?php

namespace App\Traits;

/**
 * Class Impersonate
 */
trait Impersonate
{
    public function canImpersonate(): bool
    {
        return $this->hasRole(['Administrator', 'Executive']);
    }

    /**
     * Return true or false if the user can be impersonate.
     *
     * @param void
     */
    public function canBeImpersonated(): bool
    {
        return $this->hasAnyRole(['Executive', 'User']);
    }

    public function isImpersonated(): bool
    {
        return session()->has($this->getSessionKey());
    }

    public function getSessionKey(): string
    {
        return config('impersonate.session_key');
    }
}
