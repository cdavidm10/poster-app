<?php

class LoaderData
{
    private array $data;
    private String $file_name;

    public function __construct(String $file_name)
    {
        $this->file_name = $file_name;
        $this->setData();
    }

    public function setData(): void
    {
        $data = file_get_contents(SITE_ROOT . 'data/' . $this->file_name . '.json') ?
            file_get_contents(SITE_ROOT . 'data/' . $this->file_name . '.json') :
            '{}';
        $this->data = json_decode($data, true);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function saveData(array $data): void
    {
        file_put_contents(SITE_ROOT . 'data/' . $this->file_name . '.json', json_encode($data));
    }
}
