<?php

class User
{
    private String $username;
    private String $email;
    private String $phone;
    private String $password;

    public function __construct(array $data)
    {
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->password = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    public function getUsername(): String
    {
        return $this->username;
    }

    public function getEmail(): String
    {
        return $this->email;
    }

    public function getPhone(): String
    {
        return $this->phone;
    }

    public function getPassword(): String
    {
        return $this->password;
    }
}
