<?php

namespace app\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Resort;

class ResortsController extends Controller
{
    /**
     * @api {get} /v1/resorts Request list of resorts
     * @apiName index
     * @apiGroup Resorts
     * @apiVersion 1.0.0
     * @apiUse Pagination
     * @apiUse Authorization
     *
     * @apiSuccess {Resort[]} data List of resorts
     * @apiSuccess {Number} data.id Resort's id
     * @apiSuccess {String} data.name Resort's name
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $resorts = Resort::paginate();

        return response()->json($resorts);
    }

    /**
     * @api {get} /v1/resorts/:id Request resort information
     * @apiName show
     * @apiGroup Resorts
     * @apiVersion 1.0.0
     * @apiUse Authorization
     *
     * @apiParam {Number} id Resort's id
     *
     * @apiSuccess {Number} id Resort's id
     * @apiSuccess {String} name Resort's name
     *
     * @apiSuccessExample {json} Success
     * {
     *      "id": 1,
     *      "name": "Szolgáltató Reszort"
     * }
     *
     * @param Resort $resort
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Resort $resort)
    {
        return response()->json($resort);
    }
}