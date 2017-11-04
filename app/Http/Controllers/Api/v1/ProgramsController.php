<?php

namespace app\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

class ProgramsController extends Controller
{
    /**
     * @apiDefine Pagination
     * @apiSuccess {Number} total Total number of result
     * @apiSuccess {Number} per_page Number of elements per page
     * @apiSuccess {Number} from Element's from
     * @apiSuccess {Number} to Element's to
     * @apiSuccess {Number} current_page Current page number (from 1)
     * @apiSuccess {Number} last_page Last page number
     * @apiSuccess {String} path Current path
     * @apiSuccess {String} next_page_url Next page's url
     * @apiSuccess {String} prev_page_url Previous page's url
     */

    /**
     * @apiDefine Authorization
     * @apiHeader {String} Authorization="PSCH <160 characters long token>" Authorization token
     */


    /**
     * @api {get} /programs Request list of programs
     * @apiName index
     * @apiGroup Programs
     * @apiVersion 1.0.0
     * @apiUse Pagination
     * @apiUse Authorization
     *
     * @apiSuccess {Program[]} data List of programs
     * @apiSuccess {Number} data.id Program's id
     * @apiSuccess {Number} data.circle_id Owner's id of program
     * @apiSuccess {String} data.name Program's name
     * @apiSuccess {DateTime} data.from Program's start date (format: YYYY-MM-DD HH:MM:SS)
     * @apiSuccess {DateTime} data.to Program's end date (format: YYYY-MM-DD HH:MM:SS)
     * @apiSuccess {String} data.location Program's location
     * @apiSuccess {String} data.summary Program's summary (short description)
     * @apiSuccess {String} data.website Program's website
     * @apiSuccess {Number} data.facebook_event_id Facebook event's id
     * @apiSuccess {String} data.poster_url Poster's url
     * @apiSuccess {DateTime} data.created_at DateTime of creation
     * @apiSuccess {DateTime} data.updated_at DateTime of update
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        /**
         * @var $programs Collection
         */
        $programs = Program::paginate(15);

        $programs->makeHidden([
            'user_id',
            'poster',
            'description',
            'display_poster',
            'display_email',
            'display_site'
        ]);

        return response()->json($programs);
    }

    /**
     * @api {get} /programs/:id Request program information
     * @apiName show
     * @apiGroup Programs
     * @apiVersion 1.0.0
     * @apiUse Authorization
     *
     * @apiParam {Number} id Program's id
     *
     * @apiSuccess {Number} id Program's id
     * @apiSuccess {Number} circle_id Owner's id of program
     * @apiSuccess {String} name Program's name
     * @apiSuccess {DateTime} from Program's start date (format: YYYY-MM-DD HH:MM:SS)
     * @apiSuccess {DateTime} to Program's end date (format: YYYY-MM-DD HH:MM:SS)
     * @apiSuccess {String} location Program's location
     * @apiSuccess {String} summary Program's summary (short description)
     * @apiSuccess {String} description Program's description (long description)
     * @apiSuccess {String} website Program's website
     * @apiSuccess {Number} facebook_event_id Facebook event's id
     * @apiSuccess {String} poster_url Poster's url
     * @apiSuccess {DateTime} created_at DateTime of creation (format: YYYY-MM-DD HH:MM:SS)
     * @apiSuccess {DateTime} updated_at DateTime of update (format: YYYY-MM-DD HH:MM:SS)
     *
     * @apiSuccessExample {json} Success
     * {
     *      "id": 1,
     *      "circle_id": 16,
     *      "name": "Vödör nyitás",
     *      "from": "2017-11-06 19:00:00",
     *      "to": "2017-11-06 23:50:00",
     *      "location": "Nagykonyha",
     *      "summary": "Monday = Friday",
     *      "description": "Ha hétfő, akkor Vödör!",
     *      "website": "https://facebook.com/VodorKor",
     *      "facebook_event_id": null,
     *      "poster_url": "https://program.sch.bme.hu/storage/posters/1_5ef561e5d6967cbd2bcd2d2132fd131b05d74301.png",
     *      "created_at": "2017-11-04 21:16:32",
     *      "updated_at": "2017-11-04 21:16:32"
     * }
     *
     * @param Program $program
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Program $program)
    {
        $program->makeHidden([
            'user_id',
            'poster',
            'display_poster',
            'display_email',
            'display_site'
        ]);

        return response()->json($program);
    }
}