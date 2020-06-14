<?php

class Authenticator
{
    private User $user;

    public function __construct()
    {
        session_start();
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $_SESSION['user'];
    }

    public function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    public function login(User $user): void
    {
        $this->setUser($user);
        $_SESSION['user'] = $this->user;
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
    }
}
