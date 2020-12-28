<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JWTAuth;
use Tymon\JWTAuth\Http\Parser\Parser;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Support\CustomClaims;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;

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
     *
     * @bodyParam email      string  required The email of the user.
     * @bodyParam username   string  required The choosen username.
     * @bodyParam password   string  required The choosen password.
     * @bodyParam first_name string  required The choosen first name.
     * @bodyParam last_name  string  required The choosen last name.
     * @bodyParam city       string  required The user city.
     * @bodyParam address    string  optional The user address.
     * @bodyParam gender     bool    required The user gender.
     * @bodyParam birthdate  Date    required The use birth date.
     * @bodyParam role       integer required The user role ( manager or customer).
     * @response 200{
     *  
     * }
     * @response  400{
     * "username": [
     *    "Username already exists"
     * ]
     * }
     * @response  400{
     * "password": [
     *    "Invalid password less than 6 chars"
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
        return;
    }


    /**
     * login
     * Validates user's credentials and logs him in.
     * Success Cases :
     * 1) return JWT token to ensure that the user loggedin successfully.
     * failure Cases:
     * 1) username is not found.
     * 2) invalid password.
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
        return;
    }


}
