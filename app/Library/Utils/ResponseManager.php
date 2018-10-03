<?php

namespace App\Library\Utils;

/**
 *
 * ResponseManager class to generate response for result or error in following pattern
 *
 *      success - true / false
 *      message - string message
 *      data - it can be anything
 *
 * Class ResponseManager
 *
 */
class ResponseManager {

    /**
     * Generates result response object
     *
     * @param mixed  $data
     * @param string $message
     *
     * @return array
     */
    public static $response = array('flag' => true, 'data' => '', 'message' => '', 'code' => 01);

    public static function getResult($flag = true, $data = '', $message = '', $code = 10) {
        self::$response['flag'] = $flag;
        self::$response['code'] = $code;
        self::$response['data'] = $data;
        self::$response['message'] = $message;
        return self::$response;
    }

    /**
     * Generates error response object
     *
     * @param int    $errorCode
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    public static function getError($flag = FALSE, $data = '', $message = '', $code = 10) {
        self::$response['flag'] = $flag;
        self::$response['code'] = $code;
        self::$response['data'] = $data;
        self::$response['message'] = $message;
        return self::$response;
    }

}
