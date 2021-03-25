<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group EFA manager
 *
 * Control the user interaction with other users
 */

class EFAManagerController extends Controller
{

    /**
    * createMatch
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
    * create new match event.
    *
    * function description here.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function createMatch(Request $request) 
    {
        return;
    }

    /**
    * editMatch
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
    * edit match details.
    *
    * function description here.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function editMatch(Request $request) 
    {
        return;
    }

    /**
    * createStudium
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
    * create new stadium.
    *
    * function description here.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function createStadium(Request $request)
    {
        return;
    }
    
    /**
    * getStaduims
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
    * retrieve the available staduims on the website.
    *
    * function description here.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function getStaduims(Request $request) 
    {
        return;
    } 
     
}
