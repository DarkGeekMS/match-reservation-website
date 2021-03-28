<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Match;
use App\Models\Stadiums;

class GeneralController extends Controller
{
    
    /**
    * Logout
    * Logs out a user.
    * Success Cases :
    * 1) return token equals to null to ensure that the user is logout successfully.
    * failure Cases:
    * 1) Token invalid

    * @response{
    * "token":null
    * }
    * @response  400{
    * "token_error":"wrong number of segments"
    * }
    * @bodyParam token JWT required Used to verify the user.
    */
    /**
    * Logs out a user from the website.
    *
    * The function firstly extracts the token and invalidates it if any error
    * happens it will return an error message, else it will return the token
    * value equals to null to indicate a successfull logout.
    *
    * @param Request $request  
    *
    * @return Json returns null or an error message.
    */
    public function logout(Request $request)
    {
        try {
            //Trying to parse the token given from the request
            $token = JWTAuth::parseToken();
            $token->invalidate(); // Blocking the token
        } catch (JWTException $e) {
            //Returning token error with 400 status code
            return response()->json(['token_error' => $e->getMessage()], 400);
        }
        //Returning the token with null value with 200 status code
        return response()->json(['token' => null], 200);
    }

    /**
    * getReservations
    * return the stadium seats and the reserved seats for a given match.
    * Success Cases :
    * 1) return the reservations and match dimensions.
    * failure Cases:
    * 2) match not exists.
    *
    *
    * @response 200{
    *  "reservations": {
    *    "stadium_shape": {
    *        "seats_number": 120,
    *        "rows_number": 50
    *    },
    *    "reservations": [
    *        {
    *            "seat_number": 5,
    *            "row_number": 2
    *        }
    *    ],
    *    "user_reservations": [
    *        {
    *            "seat_number": 12,
    *            "row_number": 3
    *        }
    *   ]
    * }
    *
    * @response  400{
    * "error":"please insert a match id"
    * }
    *
    *
    * @bodyParam match_id int required Used to return the data of that match.
    */
    /**
     * @param Request $request  
     *
     * @return json the matches details.
    */
    public function getReservations(Request $request)
    {
        //try to get the match details based on the given id
        try {
            // first get all matches details
            $match = Match::where('id', $request['match_id'])->first();
            $data['stadium_shape'] = $match->stadium;
            
        } catch (\Throwable $th) {
            return response()->json(['error' => 'please insert a match id'], 400);
        }

        //check if the request from a logged in user
        try {
            $user = new CustomerController;
            $userID = $user->me($request)->getData()->user->id;
            $data['reservations'] = $match->reservations->where('fan_id' , '<>' , $userID)->makeHidden('fan_id')->values();
            $data['user_reservations'] = $match->reservations->where('fan_id' , $userID)->makeHidden('fan_id')->values();
            return response()->json(['reservations' => $data], 200);

        // if the request from guest user
        } catch (\Throwable $th) {
            $data['reservations'] = $match->reservations->makeHidden('fan_id');
            return response()->json(['reservations' => $data ], 200);
        } 
        
    }

    /**
    * matchDetails
    * return the matches details for a guest user 
    * Success Cases :
    * 1) return details successfully.
    *
    * @response{
    * "matches": [
    *   {
    *        "id": 1,
    *        "home_team": "real madrid",
    *        "away_team": "barcelona",
    *        "match_venu": 1,
    *        "main_referee": "Mike Dean",
    *        "first_linesman": "Paul Rees",
    *        "second_linesman": "Paul Evans",
    *        "date": "2021-06-15",
    *        "time": "20:00:00" 
    *    },
    *    {
    *        "id": 2,
    *        "home_team": "bayern",
    *        "away_team": "barcelona",
    *        "match_venu": 4,
    *        "main_referee": "Anthony Taylor",
    *        "first_linesman": "John Flynn",
    *        "second_linesman": "Nicholas Cooper",
    *        "date": "2021-08-21",
    *        "time": "20:00:00",
    *    }
    * ]
    */
    /**
     * view matches details to any user.
     *
     *
     * @param Request $request  
     *
     * @return json the matches details.
     */

    public function matchDetails(Request $request) {

        // first get all matches details
        $matches = Match::get();
        for ($i=0; $i < sizeof($matches); $i++) { 
            $matches[$i]['stadium'] = $matches[$i]->stadium;
            $matches[$i]['reservations'] = $matches[$i]->reservations;
        }

        //check if the request from a logged in user
        try {
            $user = new CustomerController;
            $userID = $user->me($request)->getData()->user->id;
            return response()->json(['matches' => $matches], 200);

        // if the request from guest user
        } catch (\Throwable $th) {
            return response()->json(['matches' => $matches ], 200);
        } 
        
    }
}
