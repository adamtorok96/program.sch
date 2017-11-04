<?php

namespace app\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Database\Eloquent\Collection;

class CirclesController extends Controller
{
    /**
     * @apiDefine Pagination
     * @apiSuccess {Number} total
     * @apiSuccess {Number} per_page
     * @apiSuccess {Number} from
     * @apiSuccess {Number} to
     * @apiSuccess {Number} current_page Current page (from 1)
     * @apiSuccess {Number} last_page
     * @apiSuccess {String} path Current path
     * @apiSuccess {String} next_page_url
     * @apiSuccess {String} prev_page_url
     */

    /**
     * @api {get} /circles Get circles
     * @apiName GetCircles
     * @apiGroup Circles
     * @apiUse Pagination
     *
     * @apiSuccess {Circle[]} data List of circles
     * @apiSuccess {Number} data.id Circle's id
     * @apiSuccess {Number} data.resort_id Circle's resort id (null if not connected)
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

    public function show(Circle $circle)
    {
        $circle->makeHidden([
            'active'
        ]);

        return response()->json($circle);
    }
}