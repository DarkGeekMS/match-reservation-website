<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * updatePrefs
     * Updates the preferences of the user.
     * Success Cases :
     * 1) return true to ensure that the data updated successfully.
     * failure Cases:
     * 1) NoAccessRight token is not authorized.
     *
     * @bodyParam first_name string  Enable changing the username.
     * @bodyParam last_name  string  Enable changing the fullname.
     * @bodyParam city       string  Enable changing the email.
     * @bodyParam birthdate  Date    Enable changing the profile picture.
     * @bodyParam token JWT required Used to verify the user.
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
        return;
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
    *
    * }
    * @response 400{
    * "error" : "error_message
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
        return;
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
    * "":""
    * }
    * @response 400{
    * "":""
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
        return;
    }

    /**
    * makeReservation
    * to make reservation to a match.
    * Success Cases :
    * 1) return ture to ensure the reservation done successfully.
    * failure Cases:
    * 1) match id doesn't exist.
    * 
    * @bodyParam 
    * @bodyParam 
    * @bodyParam 
    * 
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
        return;
    }

    /**
    * getReservations
    * to get all reservation to any match from specific user.
    * Success Cases :
    * 1) .
    * failure Cases:
    * 1).
    * 
    * @bodyParam 
    * @bodyParam 
    * @bodyParam 
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
        return;
    }

    /**
    * cancelReservation
    * to cancel reservation to a match.
    * Success Cases :
    * 1) return ture to ensure the reservation cancelled.
    * failure Cases:
    * 1) No reservation exists.
    * 
    * @bodyParam 
    * @bodyParam 
    * @bodyParam 
    * 
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
        return;
    }
}
