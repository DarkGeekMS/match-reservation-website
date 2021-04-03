<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use JWTAuth;
use Tymon\JWTAuth\Http\Parser\Parser;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Support\CustomClaims;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;
use App\Models\User;

/**
 * @group Guests
 *
 * Control the user logining cases
 */

class GuestController extends Controller
{


    /**
     * SignUp
     * Registers new user into the website.
     * Success Cases :
     * 1) return message waiting the site admin to approve the registeration.
     * failure Cases:
     * 1) username already exits.
     * 2) password less than 6 chars.
     * 3) invalid email.
     * 4) data not complete.
     * 
     * @bodyParam email      string  required The email of the user.
     * @bodyParam username   string  required The choosen username.
     * @bodyParam password   string  required The choosen password.
     * @bodyParam first_name string  required The choosen first name.
     * @bodyParam last_name  string  required The choosen last name.
     * @bodyParam city       string  required The user city.
     * @bodyParam address    string  optional The user address.
     * @bodyParam gender     integer required The user gender ( 0: male , 1:female).
     * @bodyParam birthdate  Date    required The use birth date.
     * @bodyParam role       integer required The user role ( 1: manager , 0:customer).
     * @response 200{
     *  ["waiting for approval from the site admin"]
     * }
     * @response  400{
     * "error": [
     *    "Username Already exists"
     * ]
     * }
     * @response  400{
     * "error": [
     *    "Invalid password less than 6 chars"
     * ]
     * }
     * @response  400{
     * "error": [
     *    "Invalid Email please enter a valid one"
     * ]
     * }
     * @response  400{
     * "error": [
     *    "complete the required data first "
     * ]
     * }
     */
    /**
     * Registers the given user into the website.
     *
     * Function Description
     *
     * @param Request $request  
     *
     * @return json
     */
    public function signUp(Request $request)
    {
        //validating the input username to be unique
        $validator1 = Validator::make( $request->all(),[ 'username' => 'required|string|max:50|unique:users' ]   );

        if ($validator1->fails()) {
            return response()->json(['error' => 'Username Already exists'], 400);
        }

        // validating the password less than 6 chars
        $validator2 = Validator::make( $request->all(), [ 'password' => 'required|string|min:6' ]     );

        if ($validator2->fails()) {
            return response()->json(['error' => 'Invalid password less than 6 chars'], 400);
        }

        // validating the email
        $validator3 = Validator::make(  $request->all(), [ 'email' => 'required|string|email|max:100' ]   );

        if ($validator3->fails()) {
            return response()->json(['error' => 'Invalid Email please enter a valid one'], 400);
        }

        // validating the rest data
        $validator4 = Validator::make(
            $request->all(), [
            'first_name' => 'required|string|alpha_dash|max:50',
            'last_name'  => 'required|string|alpha_dash|max:50',
            'city'       => 'required|string|alpha|max:50',
            'gender'     => ['required', Rule::in([0, 1]),],
            'birthdate'  => 'required|Date',
            'role'       => ['required', Rule::in([1, 2]),], ]);

        if ($validator4->fails()) {
            return response()->json(['error' => 'complete the required data first'], 400);
        }

        if ($request->has("address") && $request['address'] == "") {
            $request["address"] = null;
        }

        // get the last user id to  calculate the id of the current user
        $lastUser =User::withTrashed()->get()->max('id');
        $id = $lastUser +1;

        $requestData = $request->all();
        $requestData['id'] = $id;

         // Hashing the password
        $password = $requestData["password"];
        $requestData["password"] = Hash::make($password);

        //creating new user with the posted data from the request
        $user = new User($requestData);
        $user->id = $id;
        $user->save();

        //Returning message indicates the user added to db and waiting for approval
        return response()->json('waiting for approval from the site admin', 200);
    }


    /**
     * login
     * Validates user's credentials and logs him in.
     * Success Cases :
     * 1) return JWT token to ensure that the user logged in successfully.
     * failure Cases:
     * 1) username is not found.
     * 2) invalid password.
     * 3) user not approved by any admin yet.
     *
     * @bodyParam username string required The user's username.
     * @bodyParam password string required The user's password.
     * @response 200{
     * "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9X2luIiwiaWF0IjoxNTUzMD"
     * }
     * @response  400{
     * "error": "invalid_credentials"
     * }
     * @response  400{
     * "error": "user not found please make sure you entered a valid username !"
     * }
     * @response  400{
     * "error": "waiting for approval from the site admin"
     * }
     * @response  400{
     * "error": "could_not_create_token"
     * }
     */
    /**
     * Signs in the user into the website.
     *
     * Function description.
     *
     * @param Request $request  
     *
     * @return JWT The user's JWT token.
     */
    public function login(Request $request)
    {
        //Selecting username and password from the request data
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $request['username'])->first();
        $role = $user['role'];
        if ($user == NULL) {
            return response()->json(['error' => 'user not found please make sure you entered a valid username !'], 400);

        } elseif ($user['verified'] == false) {
            return response()->json(['error' => 'waiting for approval from the site admin'], 400);
        }
        try {
            //Trying logging in with the given credentials
            if (!$token = JWTAuth::attempt($credentials)) {
                //Returning invalid credentials error with 400 status code
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            //Returning an error if the token cannot be created with 400 status code
            return response()->json(['error' => 'could_not_create_token'], 400);
        }
        //Returning the token
        return response()->json(compact('token', 'role'));
    }


}
