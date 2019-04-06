<?php

class RestClient    {
    static function call($method, $requestData) {
        
        
        $requestHeader = array('request_type', $method);


        $data = array_merge($requestHeader, $requestData);

        //set options for our context

        $options = array(
            'http' => array(
                'header' => 'Content-Type: application/x-www-form-urlencoded\r\n',
                'method' => $method,
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);

        $result = file_get_contents(API_URL, false, $context);

        return $result;

    }
}