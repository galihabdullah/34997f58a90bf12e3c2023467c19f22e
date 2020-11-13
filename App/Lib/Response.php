<?php


namespace App\Lib;


class Response
{
    private $status = 200;

    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }

    public function toJSON($data = [])
    {
        http_response_code($this->status);
        header("Content-Type: application/json");
        echo json_encode($data);
        return $this;
    }

    public function renderHtml($source)
    {
        http_response_code($this->status);
        $html = file_get_contents($source);
        echo $html;
        return $this;
    }

}