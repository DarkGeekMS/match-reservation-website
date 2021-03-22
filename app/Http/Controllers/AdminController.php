<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group site administration
 *
 * Control the site admin functionalitites
 */

class AdminController extends Controller
{
    /**
     * approveUser
     * shot description 
     * Success Cases :
     * 1)
     * 
     * Failure Cases:
     * 1)
     * 
     * 
     * @bodyParam
     * @bodyParam
     * 
     * @response 200{
     * "": ""
     * }
     * @response  400{
     * "error": "error_message"
     * }
     * @response  404{
     * "error": "not_found_error_message"
     * }
     */
    /**
     * approve user to be able to login the website.
     *
     * function description here.
     *
     * @param Request $request  
     *
     * @return json 
     */

    public function approveUser(Request $request) 
    {
        return;
    }

    /**
    * deleteUser
    * shot description 
    * Success Cases :
    * 1)
    * 
    * Failure Cases:
    * 1)
    * 
    * 
    * @bodyParam 
    * @bodyParam 
    * 
    * @response 200{
    * "": ""
    * }
    * @response  400{
    * "error": "error_message"
    * }
    * @response  404{
    * "error": "not_found_error_message"
    * }
    */
    /**
    * delete customer/manager user.
    *
    * function description here.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function deleteUser(Request $request) 
    {
        return;
    }

    /**
    * getCurretUsers
    * shot description 
    * Success Cases :
    * 1)
    * 
    * Failure Cases:
    * 1)
    * 
    * 
    * @bodyParam 
    * @bodyParam 
    * 
    * @response 200{
    * "": ""
    * }
    * @response  400{
    * "error": "error_message"
    * }
    * @response  404{
    * "error": "not_found_error_message"
    * }
    */
    /**
    * retreive current users in the website.
    *
    * function description here.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function getCurretUsers(Request $request)
    {
        return;
    }

        /**
    * getBinnedUsers
    * shot description 
    * Success Cases :
    * 1)
    * 
    * Failure Cases:
    * 1)
    * 
    * 
    * @bodyParam 
    * @bodyParam 
    * 
    * @response 200{
    * "": ""
    * }
    * @response  400{
    * "error": "error_message"
    * }
    * @response  404{
    * "error": "not_found_error_message"
    * }
    */
    /**
    * retreive the binned users ( signed up and waiting for confirmation ) in the website.
    *
    * function description here.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function getBinnedUsers(Request $request)
    {
        return;
    }
}
