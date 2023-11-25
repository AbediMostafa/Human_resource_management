<?php

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpKernel\Exception\HttpException;

if (!function_exists('jsonError')) {
    /**
     * Return error status and message to the front
     *
     * @param $msg
     * @param bool|array $additional
     * @return array
     */
    #[ArrayShape(['withResponse' => "bool", 'status' => "int", 'msg' => ""])]
    function jsonError($msg, bool|array $additional = []): array
    {
        return $additional ?
            [
                'withResponse' => true,
                'status' => 0,
                'msg' => $msg,
                ...$additional
            ] :
            [
                'withResponse' => true,
                'status' => 0,
                'msg' => $msg
            ];
    }
}

if (!function_exists('jsonSuccess')) {
    /**
     * Return success status and message to the front
     *
     * @param $msg
     * @param bool|array $additional
     * @return array
     */
    #[ArrayShape(['status' => "int", 'msg' => "string"])]
    function jsonSuccess($msg, bool|array $additional = []): array
    {
        return $additional ?
            [
                'withResponse' => true,
                'status' => 1,
                'msg' => $msg,
                ...$additional
            ] :
            [
                'withResponse' => true,
                'status' => 1,
                'msg' => $msg,
            ];
    }
}

if (!function_exists('requestHas')) {
    /**
     * Return true if request has key and key has value
     *
     * @param string $key
     * @return bool
     */
    #[ArrayShape(['key' => "string"])]
    function requestHas(string $key): bool
    {
        return request()->has($key) && request($key);
    }
}

if (!function_exists('tryCatch')) {

    /**
     * Simplifies try catch block
     *
     * @param $callB
     * @param $successMsg
     * @param $errorMsg
     * @return array
     */
    function tryCatch($callB, $successMsg, $errorMsg)
    {
        try {
            $callB();

            return jsonSuccess($successMsg);

        } catch (Exception $e) {

            if(get_class($e) === 'Symfony\Component\HttpKernel\Exception\HttpException'){
                throw new HttpException(422, $e->getMessage());
            }

            /**
             * TODO : in production mode replace with $errorMsg
             */
            return jsonError($e->getMessage());
        }
    }
}

/**
 * Get current called route
 *
 * @return mixed
 */
function callingRoute(): mixed
{
    return last(r()->segments());
}

/**
 * Get current called method
 *
 * @return mixed
 */
function callingMethod(): mixed
{
    return r()->input('method');
}

/**
 * A shorthand of request method
 *
 * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|mixed|string|null
 */
function r($value = ''): mixed
{
    return $value ? request($value) : request();
}
