<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use App\Models\Match;
use App\Models\Stadiums;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;
use Tymon\JWTAuth\Http\Parser\Parser;


class CustomerController extends Controller
{
    /**
     * updatePrefs
     * Updates the preferences of the user.
     * Success Cases :
     * 1 - Entering valid data
     * failure Cases:
     * 1) NoAccessRight token is not authorized.
     * 2) invalid data
     *
     * @bodyParam first_name string  Enable changing the username.
     * @bodyParam last_name  string  Enable changing the fullname.
     * @bodyParam city       string  Enable changing the email.
     * @bodyParam birthdate  Date    Enable changing the profile picture.
     * @bodyParam token JWT required Used to verify the user.
    * @response 200{
    *   true
    * }
    * @response  400{
    * "error": "Invalid data format"
    * }
    * }
    * @response 400{
    * "error" : "Not authorized"
    * }
     */
    /**
     * Changes the preferences of the user.
     *
     * Function description
     *
     * @param Request $request  
     *
     * @return boolean returns true or an error message.
     */
    public function updatePrefs(Request $request)
    {
        $customer = new CustomerController;
        $customer_data = $customer->me($request)->getData()->user;
        $user = User::where("id", $customer_data->id)->first();
        $validator = validator(
            $request->all(),
            [
                "first_name" => "string",
                "last_name" => "string",
                "city" => "string",
                "birthdate" => "date",
                "address" => "string",
                "email" => "string|email",
                "gender" =>  Rule::in([0, 1]),
            ]
        );

        if ($validator->fails())
            return response()->json(['error' => 'Invalid data format'], 400);

        if ($request->has("first_name"))
            $user->first_name = $request["first_name"];

        if ($request->has("last_name"))
            $user->last_name = $request["last_name"];

        if ($request->has("city"))
            $user->city = $request["city"];

        if ($request->has("birthdate"))
            $user->birthdate = $request["birthdate"];

        if ($request->has("address"))
            $user->address = $request["address"];

        if ($request->has("email"))
            $user->email = $request["email"];

        if ($request->has("gender"))
            $user->gender = $request["gender"];

        $user->save();

        return response()->json(true);
    }

    /**
    * getPrefs
    * Returns the preferences of the user.
    * Success Cases :
    * 1) return the preferences of the logged-in user.
    * failure Cases:
    * 1) NoAccessRight token is not authorized.
    *
    * @bodyParam token JWT required Used to verify the user.
    * @response 200{
    * {
    *   "first_name": "mohamed",
    *   "last_name": "3zoz",
    *   "gender": 1,
    *   "city": "cairo",
    *   "address": "4 3zoz street"
    *}
    * }
    * @response 400{
    * "error" : "Not authorized"
    * }
    */
    /**
    * Gets the preferences of the user.
    *
    * Function description
    *
    * @param Request $request  
    *
    * @return Json holds the  user preferences username, email,
    * first name, last name, gender, city, address.
    */
    public function getPrefs(Request $request)
    {
        $customer = new CustomerController;
        $customer_data = $customer->me($request)->getData()->user;
        $user = User::where("id", $customer_data->id)->first();
        $prefs = $user->only(["first_name", "last_name", "gender", "city", "address", "email", "birthdate"]);
        if($prefs['address'] == null) {
            $prefs['address'] = "";
        }
        return response()->json($prefs);
    }


    /**
    * changePassword
    * change the user password.
    * Success Cases :
    * 1) password changed successfully.
    * failure Cases:
    * 1) NoAccessRight token is not authorized.
    *
    * @bodyParam token         JWT   required Used to verify the user.
    * @bodyParam new_password string required Used to update the password of the user.

    * @response 200{
    * true
    * }
    * @response 400{
    *   "error": 'Invalid password less than 6 chars'
    * }
    * @response 400{
    *   "error": 'Not authorized'
    * }
    */
    /**
    * change the user password.
    *
    * Function description
    *
    * @param Request $request  
    *
    * @return Json 
    */
    public function changePassword(Request $request) 
    {
        $customer = new CustomerController;
        $customer_data = $customer->me($request)->getData()->user;
        $user = User::where("id", $customer_data->id)->first();
        $validator = Validator::make( $request->all(), [ 'new_password' => 'required|string|min:6' ]     );

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid password less than 6 chars'], 400);
        }

        $user->password = Hash::make($request["new_password"]);

        $user->save();

        return response()->json(true);

    }

    /**
    * makeReservation
    * to make reservation to a match.
    * Success Cases :
    * 1) return ticket id to ensure the reservation done successfully.
    * failure Cases:
    * 1) match id doesn't exist.
    * 2) place in stadium not valid
    * 3) reservation already exists
    * 
    * @bodyParam match_id Integer required id of required match.
    * @bodyParam seat_number  Integer  required the required seat number.
    * @bodyParam row_number  Integer  required the required row number.
    * @bodyParam token JWT required Used to verify the user.
    * 
    * @response 200{
    *   10
    * }
    * @response 400{
    *   "error": 'Invalid reservation data'
    * }
    * @response 400{
    *   "error": 'previous reservation already exists'
    * }
    * @response 400{
    *   "error": 'no such match exist'
    * }
    * @response 400{
    *   "error": 'invalid place in the stadium'
    * }
    * @response 400{
    *   "error": 'Not authorized'
    * }
    */

    /**
    * make reservation to a match.
    *
    * Function Description
    * 
    * @param Request $request  
    *
    * @return Json
    */
    public function makeReservation(Request $request) 
    {
        $customer = new CustomerController;
        $customer_data = $customer->me($request)->getData()->user;
        
        $validator = validator(
            $request->all(),
            [
                "match_id" => "required|integer",
                "seat_number" => "required|integer",
                "row_number" => "required|integer"
            ]
        );

        if ($validator->fails())
            return response()->json(["error" => "invalid reservation data"], 400);

        $match_id = $request["match_id"];
        $seat_number = $request["seat_number"];
        $row_number = $request["row_number"];        
        $prevReserv = Reservation::where('match_id', '=', $match_id, 'and')->where('seat_number', '=', $seat_number, 'and')->where('row_number', '=', $row_number)->first();

        if ($prevReserv)
            return response()->json(["error" => "previous reservation already exists"], 400);

        $match = Match::where("id", $match_id)->first();


        if(!$match)
            return response()->json(["error" => "no such match exist"], 400);

        $stadium_id = $match->match_venu;

        $stadium = Stadiums::where("id", $stadium_id)->first();

        if (!($seat_number >= 1 && $seat_number <= $stadium->seats_number && $row_number >= 1 && $row_number <= $stadium->rows_number))
            return response()->json(["error" => "invalid place in the stadium"], 400);


        $last_ticket = Reservation::all()->max('ticket_number');
        $ticket_number = $last_ticket +1;

        $requestData = $request->all();
        $requestData['ticket_number'] = $ticket_number;
        $requestData["fan_id"] = $customer_data->id;

        $reservation = new Reservation($requestData);
        $reservation->save();
        return response()->json($ticket_number);
    }

    /**
    * getReservations
    * to get all reservation to any match from specific user.
    * Success Cases :
    * 1) Token is valid so reservations are returned
    * failure Cases:
    * 1) Token is invalid
    * 
    * @bodyParam token JWT required Used to verify the user.

    *@response 200{
    *    {
    *        "ticket_number": 10,
    *        "match_id": 2,
    *        "fan_id": 5,
    *        "seat_number": 25,
    *        "row_number": 25
    *    },
    *    {
    *        "ticket_number": 11,
    *        "match_id": 3,
    *       "fan_id": 5,
    *        "seat_number": 25,
    *        "row_number": 25
    *    }
    *}

    * @response 400{
    *   "error": 'Not authorized'
    * }
    * 
    */

    /**
    *
    *
    * Function Description
    * 
    * @param Request $request  
    *
    * @return Json
    */
    public function getReservations(Request $request) 
    {
        $customer = new CustomerController;
        $customer_data = $customer->me($request)->getData()->user;
        $reservations = Reservation::where("fan_id", $customer_data->id)->get();
        return response()->json($reservations);
    }

    /**
    * cancelReservation
    * to cancel reservation to a match.
    * Success Cases :
    * 1) return ture to ensure the reservation cancelled.
    * failure Cases:
    * 1) No reservation exists.
    * 2) Reservation doesn't belong to user
    * 3) < 3 days remaining for the match
    * 
    * @bodyParam ticken_number Integer required number of ticket to be deleted.
    * @bodyParam token JWT required Used to verify the user.
    * 
    *@response 200 {
    *   true
    *}

    * @response 400{
    *   "error": 'Invalid data format'
    * }
    * @response 400{
    *   "error": 'no such reservation exists'
    * }
    * @response 400{
    *   "error": 'reservation doesn't belong to that user'
    * }
    * @response 400{
    *   "error": 'less than 3 days remaining on the match'
    * }
    * @response 400{
    *   "error": 'Not authorized'
    * }


    */

    /**
    * cancel a reservation to a match , note: a user can't cancel a reservation before 3 days or less to the match event.
    *
    * Function Description
    * 
    * @param Request $request  
    *
    * @return Json
    */
    public function cancelReservation(Request $request) 
    {
        $customer = new CustomerController;
        $customer_data = $customer->me($request)->getData()->user;
        $reservations = Reservation::where("fan_id", $customer_data->id)->get();

        $validator = validator(
            $request->all(),
            [
                "ticket_number" => "required|integer",
            ]
        );

        if($validator->fails())
            return response()->json(["error" => "invalid data format"],400);

        $ticket_number = $request["ticket_number"];

        $reservation = Reservation::where("ticket_number", $ticket_number)->first();
        if (!$reservation)
            return response()->json(["error" => "no such reservation exists"],400);

        if ($reservation->fan_id != $customer_data->id)
            return response()->json(["error" => "reservation doesn't belong to that user"],400);

        $match = Match::where("id", $reservation->match_id)->first();

        $today_date = date('Y-m-d H:i:s');

        $today_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $today_date);

        $match_date = $match->date;
        $match_time = $match->time;

        $match_date = \Carbon\Carbon::createFromFormat('Y-m-d  H:i:s', $match_date . " " . $match_time);

        $days_diff = $match_date->diffInDays($today_date);

        if($days_diff < 3){
            return response()->json(["error" => "less than 3 days remaining on the match"], 400);
        }

        Reservation::where('ticket_number', $ticket_number)->delete();

        return response()->json(true);
    }


        /**
     * Me
     * Returns the identity of the user logged in.
     * Success Cases :
     * 1) return the user object of the sent token as json.
     * failure Cases:
     * 1) NoAccessRight token is not authorized.
     *
     * }
     * @response  404{
     * "error" : "user_not_found"
     * }
     * @response  400{
     * "token_error":"The token has been blacklisted"
     * }
     * @bodyParam token JWT required Used to verify the user.
     */
    /**
     * Returns the user of the sent token.
     *
     * The function extracts the token given in the request then it checks if it
     * corresponds to an existing user then it will return an error if that is
     * case else it will return the user object of the token.
     *
     * @param Request $request  
     *
     * @return Json The user's object as json or an error message.
     */
    public function me(Request $request)
    {
        try {
            //Parsing the given token, trying to login and getting user data
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                /*Returning error if the token is a valid JWT but the encoded
                user doesn't exist with 404 status code*/
                return response()->json(['error' => 'user_not_found'], 404);
            }
        } catch (JWTException $e) {
            //Returning token error with the error message if any error occured
            return response()->json(['token_error' => $e->getMessage()], 400);
        }
        //Returning the data of the user with 200 status code
        return response()->json(compact('user'));
    }

}
