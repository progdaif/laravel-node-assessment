<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;
use App\Lib\ApiResponder;
use Throwable;

/**
 * Abstract class Controller
 *
 * Super class for controllers
 *
 * @package namespace App\Http\Controllers;
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
    use ApiResponder;

    /**
     * Throw error
     *
     * Throw error formatted
     *
     * @param Throwable $e
     * @param $data
     *
     * @return $this
     */
    protected function throwError(Throwable $e, $data =[])
    {
        $code = $e->getCode();
        if (empty($code) || !is_int($code)) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return $this->errorResponse($data, $e->getMessage(), (int) $code);
    }
}