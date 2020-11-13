<?php


namespace App\Lib;


class Request
{
    public $params;
    public $reqMethod;
    public $contentType;

    public function __construct($params=[])
    {
        $this->params = $params;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : "";
    }

    public function getBody()
    {
        $body = [];
        foreach ($_POST as $key => $value){
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }

    public function getJson()
    {
        if($this->reqMethod !== 'POST'){
            return [];
        }
        if(strcasecmp($this->contentType, "application/json") !== 0){
            return [];
        }
        $content = trim(file_get_contents("php://input"));
        return json_decode($content, true);
    }

    /**
     * Get header Authorization
     * */
    function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    /**
     * get access token from header
     * */
    function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}