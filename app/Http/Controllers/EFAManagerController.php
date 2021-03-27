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
    * Creates a new match event with given data.
    *
    * Success Cases :
    * 1) Match created successfully and added to database.
    * 
    * Failure Cases:
    * 1) Match teams not passed correctly.
    * 2) Match data not passed correctly.
    * 3) Match venue does not exist.
    * 
    * @bodyParam home_team       string  required The match home team
    * @bodyParam away_team       string  required The match away team
    * @bodyParam match_venu      integer required The match stadium
    * @bodyParam main_referee    string  required The match main refree
    * @bodyParam first_linesman  string  required The match first linesman
    * @bodyParam second_linesman string  required The match second linesman
    * @bodyParam date            Date    required The match date
    * @bodyParam time            Time    required The match time
    * 
    * @response 200{
    *   "New match created successfully"
    * }
    * @response  400{
    * "error": "Enter the match teams correctly"
    * }
    * @response  400{
    * "error": "Enter complete and correct match information"
    * }
    * @response  400{
    * "error": "Error creating match, check match venue"
    * }
    */
    /**
    * Creates a new match event with given data.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function createMatch(Request $request) 
    {
        // validate team names
        $home_team_validator = Validator::make($request->all(), ['home_team' => 'required|string|max:50']);
        $away_team_validator = Validator::make($request->all(), ['away_team' => 'required|string|max:50']);

        if ($home_team_validator->fails() || $away_team_validator->fails()) {
            return response()->json(['error' => 'Enter the match teams correctly'], 400);
        }

        // validate rest of data
        $rest_validator = Validator::make(
            $request->all(), [
            'match_venu'      => 'required|integer',
            'main_referee'    => 'required|string|alpha_dash|max:50',
            'first_linesman'  => 'required|string|alpha|max:50',
            'second_linesman' => 'required|string|alpha|max:50',
            'date'            => 'required|Date',
            'time'            => 'required|date_format:H:i'
            ]
        );

        if ($rest_validator->fails()) {
            return response()->json(['error' => 'Enter complete and correct match information'], 400);
        }

        // get next match id
        $last_match = Match::withTrashed()->get()->max('id');
        $id = $last_match +1;

        // create request data and add match id
        $requestData = $request->all();
        $requestData['id'] = $id;

        // try creating match
        try {
            // sucessful insertion
            $match = new Match($requestData);
            $match->id = $id;
            $match->save();
            return response()->json('New match created successfully', 200);
        } catch (\Throwable $th) {
            // insertion failure
            return response()->json(['error' => 'Error creating match, check match venue'], 400);
        }
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
