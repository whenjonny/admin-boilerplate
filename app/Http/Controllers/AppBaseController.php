<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json($this->output($result, $message));
    }

    public function sendError($error, $code = 400, $data = '')
    {
        return Response::json($this->error($error, $data, $code), $code);
    }


    /**
     * Format json, validate the response
     */
    protected function json_format($data, $ret = 1, $info = '') {
        if(empty($data)) {
            $data = new \stdClass;
        }
        return array(
            'ret' => $ret,
            'data' => $data,
            'info' => $info
        );
    }

    protected function output($data = [], $info = '') {
        return $this->json_format($data, 1, $info);
    }

    protected function error($info = '', $data = [], $code = 0) {
        $ret = 1;
        if($code>=400){
            $ret = 0;
        }
        return $this->json_format($data, $ret, $info);
    }
}
