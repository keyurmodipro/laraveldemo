<?php

namespace App\Libraries\utils;

class ResponseManager {

    public static $response = array('flag' => true, 'data' => '', 'message' => '', 'code' => 01,);
    public static $errorresponse = array('flag' => true, 'message' => '', 'code' => 01,);

    public static function getError($data = '', $code = 10, $message = '', $flag = false) {
        self::$response['flag'] = $flag;
        self::$response['code'] = $code;
        self::$response['data'] = $data;
        self::$response['message'] = $message;
        return self::$response;
    }

    public static function getResult($data = '', $code = 10, $message = '', $flag = true) {
        self::$response['flag'] = $flag;
        self::$response['code'] = $code;
        self::$response['data'] = $data;
        self::$response['message'] = $message;
        return self::$response;
    }
    
    public static function getErrorApi($flag = false, $code = 10, $message = '') {
        self::$errorresponse['flag'] = $flag;
        self::$errorresponse['code'] = $code;
        self::$errorresponse['message'] = $message;
        return self::$errorresponse;
    }

}
