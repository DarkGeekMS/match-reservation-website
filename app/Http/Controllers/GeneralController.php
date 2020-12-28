<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * matchDetails
     * return the matches details for a guest user 
     * Success Cases :
     * 1) return details successfully.
     *
     * @response{
     * "": ""
     * }
     */
    /**
     * view matches details to any user.
     *
     * function description here.
     *
     * @param Request $request  
     *
     * @return json the matches details.
     */

    public function matchDetails(Request $request) {

    }
}
