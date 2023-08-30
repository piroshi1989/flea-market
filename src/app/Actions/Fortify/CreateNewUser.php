<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Http\Requests\AuthRequest;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        app(AuthRequest::class)->validated();

        return User::create([
            'role' => 0,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}