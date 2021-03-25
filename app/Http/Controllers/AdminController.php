<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Match;
use App\Models\Stadiums;

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
     * 1) user approved
     * 
     * Failure Cases:
     * 1) user rejected
     * 
     * 
     * @bodyParam user_id int required Used to get the user to be approved.
     * @bodyParam token   JWT required Used to verify the logged in user.
     * 
     * @response 200{
     * "user_id": "approved"
     * }
     * @response  400{
     * "error": "not approved"
     * }
     * @response  404{
     * "error": "user not found"
     * }
     */
    /**
     * approve user to be able to login the website.
     *
     * this functions takes a user id and approve its account to be able to login to the app
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
    * 1) user deleted successfully.
    * 
    * Failure Cases:
    * 1) user can't be deleted.
    * 2) user not found.
    * 
    * 
    * @bodyParam user_id int required Used to get the user to be approved.
    * @bodyParam token   JWT required Used to verify the logged in user.
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
    * retreive the current users in the website
    * Success Cases :
    * 1) return all the signed up users who are verified.
    * 
    * Failure Cases:
    * 1) unauthorized user.
    * 2) the logged in user not admin.
    *  
    *
    * @bodyParam token   JWT required Used to verify the logged in user.
    * 
    * @response 200{
    * "users":  [
    *    {
    *        "username": "teto",
    *        "role": 1
    *    }
    * ]
    * }
    * @response  400{
    * "error": "you have to be admin to view this data"
    * }
    * @response  400{
    * "error": "Not authorized"
    * }
    */
    /**
    * retreive the current users  in the website.
    *
    * first check the logged in user role then retrieve the verified users if the logged in user was admin else send error message.
    *
    * @param Request $request  
    *
    * @return json
    */
    public function getCurretUsers(Request $request)
    {
        // verify the logged-in user is admin
        $user = new CustomerController;
        $userType = $user->me($request)->getData()->user->role;
        if ($userType != 3){
            return response()->json(['error' => "you have to be admin to view this data" ], 400);
        }
        // return the verified users
        $users = User::where('verified', true)->select(['username','role'])->get();
        return response()->json(['users' => $users ], 200);
    }

    /**
    * getPinnedUsers
    * retreive the pinned users
    * Success Cases :
    * 1) return all the signed up users who are not verified.
    * 
    * Failure Cases:
    * 1) unauthorized user.
    * 2) the logged in user not admin.
    *  
    * 
    * @bodyParam token   JWT required Used to verify the logged in user.
    *
    *
    * @response 200{
    * "users": [
    *    {
    *        "username": "monda",
    *        "role": 1
    *    },
    *    {
    *        "username": "shawky",
    *        "role": 3
    *    }   
    * ]
    * }
    * @response  400{
    * "error": "you have to be admin to view this data"
    * }
    * @response  400{
    * "error": "Not authorized"
    * }
    */
    /**
    * retreive the pinned users ( signed up and waiting for confirmation ) in the website.
    *
    * first check the logged in user role then retrieve the unverified users if the logged in user was admin else send error message.
    *
    * @param Request $request  
    *
    * @return json
    */

    public function getPinnedUsers(Request $request)
    {
        // verify the logged-in user is admin
        $user = new CustomerController;
        $userType = $user->me($request)->getData()->user->role;
        if ($userType != 3){
            return response()->json(['error' => "you have to be admin to view this data" ], 400);
        }
        // return the unverified users
        $users = User::where('verified', false)->select(['username','role'])->get();
        return response()->json(['users' => $users ], 200);
    }
}
