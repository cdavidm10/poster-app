<?php
class Post
{
    private String $message;
    private String $username;
    private String $date;

    public function __construct(array $data)
    {
        $this->message = $data['message'];
        $this->username = $data['username'] ?? '';
        $this->date = $data['date'] ?? date("Y.m.d");;
    }

    public function getMessage(): String
    {
        return $this->message;
    }

    public function getUsername(): String
    {
        return $this->username;
    }

    public function getDate(): String
    {
        return $this->date;
    }

    public function canBeFiltered($filter): bool
    {

        return !(strpos($this->getMessage(), $filter) ===  false);
    }
}
