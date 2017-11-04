<?php

namespace app\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Database\Eloquent\Collection;

class CirclesController extends Controller
{
    /**
     * @api {get} /circles Request list of circles
     * @apiName index
     * @apiGroup Circles
     * @apiVersion 1.0.0
     * @apiUse Pagination
     * @apiUse Authorization
     *
     * @apiSuccess {Circle[]} data List of circles
     * @apiSuccess {Number} data.id Circle's id
     * @apiSuccess {Number} data.resort_id Circle's resort id (null if not provided)
     * @apiSuccess {String} data.name Circle's name
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        /**
         * @var $circles Collection
         */
        $circles = Circle::paginate();

        $circles->makeHidden([
            'active'
        ]);

        return response()->json($circles);
    }

    /**
     * @api {get} /circles/:id Request circle information
     * @apiName show
     * @apiGroup Circles
     * @apiVersion 1.0.0
     * @apiUse Authorization
     *
     * @apiParam {Number} id Circle's id
     *
     * @apiSuccess {Number} id Circle's id
     * @apiSuccess {Number} resort_id Circle's resort id (null if not provided)
     * @apiSuccess {String} name Circle's name
     *
     * @apiSuccessExample {json} Success
     * {
     *      "id": 1,
     *      "resort_id": null,
     *      "name": "VödörKör"
     * }
     *
     * @param Circle $circle
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Circle $circle)
    {
        $circle->makeHidden([
            'active'
        ]);

        return response()->json($circle);
    }
}