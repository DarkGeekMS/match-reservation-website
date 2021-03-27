<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\User;
use App\Models\Match;
use App\Models\Stadiums;
use App\Models\Reservation;

use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

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
    * 1) User is not a manager.
    * 2) Match teams not passed correctly.
    * 3) Match data not passed correctly.
    * 4) Match venue does not exist.
    * 
    * @bodyParam home_team       string  required The match home team
    * @bodyParam away_team       string  required The match away team
    * @bodyParam match_venu      integer required The match stadium
    * @bodyParam main_referee    string  required The match main refree
    * @bodyParam first_linesman  string  required The match first linesman
    * @bodyParam second_linesman string  required The match second linesman
    * @bodyParam date            Date    required The match date
    * @bodyParam time            Time    required The match time
    * @bodyParam token           JWT     required Used to verify the user
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
        // verify logged-in user is manager
        $user = new CustomerController;
        $user_type = $user->me($request)->getData()->user->role;
        if ($user_type != 2) {
            return response()->json(['error' => "You have to be a manager to create a match event" ], 400);
        }

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
            'time'            => 'required|date_format:H:i:s'
            ]
        );

        if ($rest_validator->fails()) {
            return response()->json(['error' => 'Enter complete and correct match information'], 400);
        }

        // check whether stadium is occupied
        $matches = Match::where('match_venu', $request['match_venu'])->get();
        $match_time = Carbon::createFromFormat('Y-m-d H:i:s', $request['date'].' '.$request['time']);
        for ($i = 0; $i < sizeof($matches); $i++) {
            $other_time = Carbon::createFromFormat('Y-m-d H:s:i', $matches[$i]['date'].' '.$matches[$i]['time']);
            $diff_in_minutes = $match_time->diffInMinutes($other_time);
            if (abs($diff_in_minutes) < 120) { // 2 hours difference
                return response()->json(['error' => 'Stadium is occupied at given time'], 400);
            }
        }

        // get next match id
        $last_match = Match::get()->max('id');
        $id = $last_match + 1;

        // create request data and add match id
        $requestData = $request->only(
            'home_team', 'away_team', 'match_venu', 'main_referee', 'first_linesman', 'second_linesman', 'date', 'time'
        );
        $requestData['id'] = $id;

        // try creating match
        try {
            // sucessful insertion
            $match = new Match($requestData);
            $match->save();
            return response()->json('New match created successfully', 200);
        } catch (\Throwable $th) {
            // insertion failure
            return response()->json(['error' => 'Error creating match, check match venue'], 400);
        }
    }

    /**
    * editMatch
    * Updates match details.
    *
    * Success Cases :
    * 1) Match updated successfully.
    * 
    * Failure Cases:
    * 1) User is not a manager.
    * 2) Requested match does not exists.
    * 3) Incorrect match information.
    * 4) Cannot update stadium of reserved matches. 
    * 
    * @bodyParam match_id        string  required The match id
    * @bodyParam home_team       string  optional The match home team
    * @bodyParam away_team       string  optional The match away team
    * @bodyParam match_venu      integer optional The match stadium
    * @bodyParam main_referee    string  optional The match main refree
    * @bodyParam first_linesman  string  optional The match first linesman
    * @bodyParam second_linesman string  optional The match second linesman
    * @bodyParam date            Date    optional The match date
    * @bodyParam time            Time    optional The match time
    * @bodyParam token           JWT     required Used to verify the user
    * 
    * @response 200{
    * "Match updated successfully"
    * }
    * @response  400{
    * "error": "You have to be a manager to create a stadium"
    * }
    * @response  404{
    * "error": "Requested match does not exists"
    * }
    * @response  400{
    * "error": "Enter correct match information"
    * }
    * @response  400{
    * "error": "Cannot update stadium of reserved matches"
    * }
    */
    /**
    * Updates match details.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function editMatch(Request $request) 
    {
        // verify logged-in user is manager
        $user = new CustomerController;
        $user_type = $user->me($request)->getData()->user->role;
        if ($user_type != 2) {
            return response()->json(['error' => 'You have to be a manager to create a stadium' ], 400);
        }

        // check whether the match exists
        $match = Match::where('id', $request['match_id'])->first();
        if ($match == NULL) {
            return response()->json(['error' => 'Requested match does not exists'], 404);
        }

        // validate request data
        $data_validator = Validator::make(
            $request->all(), [
            'home_team'       => 'string|max:50',
            'away_team'       => 'string|max:50',
            'match_venu'      => 'integer',
            'main_referee'    => 'string|alpha_dash|max:50',
            'first_linesman'  => 'string|alpha|max:50',
            'second_linesman' => 'string|alpha|max:50',
            'date'            => 'Date',
            'time'            => 'date_format:H:i:s'
            ]
        );

        if ($data_validator->fails()) {
            return response()->json(['error' => 'Enter correct match information'], 400);
        }

        // abort if stadium change is requested for reserved match
        $reservations = $match->reservations;
        if ($request->has('match_venu')) {
            if (sizeof($reservations) != 0 && $match->match_venu != $request['match_venu']) {
                return response()->json(['error' => 'Cannot update stadium of reserved matches'], 400);
            }
        }

        // form update data
        if ($request->has('home_team')) {
            $match->home_team = $request['home_team'];
        }
        if ($request->has('away_team')) {
            $match->away_team = $request['away_team'];
        }
        if ($request->has('match_venu')) {
            $match->match_venu = $request['match_venu'];
        }
        if ($request->has('main_referee')) {
            $match->main_referee = $request['main_referee'];
        }
        if ($request->has('first_linesman')) {
            $match->first_linesman = $request['first_linesman'];
        }
        if ($request->has('second_linesman')) {
            $match->second_linesman = $request['second_linesman'];
        }
        if ($request->has('date')) {
            $match->date = $request['date'];
        }
        if ($request->has('time')) {
            $match->time = $request['time'];
        }

        // save changes to database
        $match->save();
        return response()->json('Match updated successfully', 200);
    }

    /**
    * createStudium
    * Creates a new stadium with given data. 
    *
    * Success Cases :
    * 1) Stadium created successfully and added to database.
    * 
    * Failure Cases:
    * 1) User is not a manager.
    * 2) Invalid dimensions.
    * 3) Stadium creation error.
    * 
    * @bodyParam rows_number   integer required number of rows in stadium
    * @bodyParam seats_number  integer required number of seats per row in stadium
    * @bodyParam token         JWT     required Used to verify the user
    * 
    * @response 200{
    * "New stadium created successfully"
    * }
    *
    * @response  400{
    * "error": "You have to be a manager to create a stadium"
    * }
    *
    * @response  400{
    * "error": "Enter correct stadium dimensions"
    * }
    *
    * @response  400{
    * "error": "Error creating stadium"
    * }
    */
    /**
    * Creates a new stadium with given data.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function createStadium(Request $request)
    {
        // verify logged-in user is manager
        $user = new CustomerController;
        $user_type = $user->me($request)->getData()->user->role;
        if ($user_type != 2) {
            return response()->json(['error' => "You have to be a manager to create a stadium" ], 400);
        }

        // validate request data
        $data_validator = Validator::make(
            $request->all(), [
            'rows_number'      => 'required|integer',
            'seats_number'    => 'required|integer'
            ]
        );

        if ($data_validator->fails()) {
            return response()->json(['error' => 'Enter correct stadium dimensions'], 400);
        }

        // get next stadium id
        $last_stadium = Stadiums::get()->max('id');
        $id = $last_stadium + 1;

        // create request data and add stadium id
        $requestData = $request->only('rows_number', 'seats_number');
        $requestData['id'] = $id;

        // try creating stadium
        try {
            // sucessful insertion
            $stadium = new Stadiums($requestData);
            $stadium->save();
            return response()->json('New stadium created successfully', 200);
        } catch (\Throwable $th) {
            // insertion failure
            return response()->json(['error' => 'Error creating stadium'], 400);
        }
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
