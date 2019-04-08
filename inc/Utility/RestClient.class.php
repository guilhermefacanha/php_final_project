<?php

class RestClient
{
    public static function call($method, $requestData)
    {
        $requestHeader = array('request_type', $method);
        $data = array_merge($requestHeader, $requestData);

        //set options for our context
        $options = array(
            'http' => array(
                'header' => 'Content-Type: application/x-www-form-urlencoded\r\n',
                'method' => $method,
                'content' => http_build_query($data),
            ),
        );

        $context = stream_context_create($options);

        $url = $_SERVER['REQUEST_URI']; //returns the current URL
        $parts = explode('/', $url);
        $dir = $_SERVER['SERVER_NAME'];
        for ($i = 0; $i < count($parts) - 1; $i++) {
            $dir .= $parts[$i] . "/";
        }
        $dir = 'http://' . $dir.API_URL;

        $result = file_get_contents($dir, false, $context);

        return $result;

    }
}
