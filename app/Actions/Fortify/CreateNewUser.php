<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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


         $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'lastname.required' => 'El apellido es obligatorio.',
            'cedula.required' => 'La cédula es obligatoria.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_of_birth.before' => 'Debes ser mayor de 18 años para registrarte.',
            'password.required' => 'La contraseña es obligatoria.',
            'terms.accepted' => 'Debes aceptar los términos y condiciones.',
        ];


        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'lastname'=>['required','string','max:255'],
            'cedula'=>['required','string','max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date_of_birth' => ['required', 'date', 'before:18 years ago'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],$messages)->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'lastname'=> $input['lastname'],
            'cedula' => $input['cedula'],
            'date_of_birth' =>$input['date_of_birth'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
