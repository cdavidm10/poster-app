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
        $this->date = $data['date'] ?? date("m/d/Y");;
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

    public function canBeFiltered(String $filter,  array $filter_dates): bool
    {
        return $this->canBefilterByMessage($filter) && $this->canBefilterByDates($filter_dates);
    }

    public function canBefilterByMessage(String $filter): bool
    {
        return !(strpos($this->getMessage(), $filter) ===  false);
    }

    public function canBefilterByDates(array $filter_dates): bool
    {
        $date_created = new DateTime($this->getDate());
        $startdate = new DateTime($filter_dates[0]);
        $enddate = new DateTime($filter_dates[1]);
        return $startdate <= $date_created && $date_created <= $enddate;
    }
}
