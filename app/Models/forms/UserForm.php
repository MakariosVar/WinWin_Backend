<?php

namespace App\Models\forms;

use Illuminate\Http\Request;

class UserForm
{
    private $user;

    public $id;
    public $username;
    public $email;

    public $password;

    public $point;
    public $verified;

    public $errors;


    public function __construct($user) {
        $this->setUser($user);
    }

    public function setUser($user) {
        $this->user = $user;
    }
    
    public function getUser() {
        return $this->user;
    }

    public function loadAndValidate(Request $request) {
    
        $validator = \Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'required|string',
            'verified' => 'nullable|boolean'
        ]);
        
        // Custom error message for the 'name' attribute
        $customMessages = [
            'username.required' => 'Το όνομα είναι απαραίτητο πεδίο.',
            'password.required' => 'Ο κωδικός είναι απαραίτητο πεδίο.',
        ];
    
        // Apply custom messages to the validator
        $validator->setCustomMessages($customMessages);
        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            return false; // Validation failed
        }
    
        // If validation passes, set the properties with the data
        $this->username = request('username');
        $this->email = request('email');

        $this->password = request('password');
        if (!isset($this->getUser()->email_verified_at) && $request->has('verified'))  {
            $this->verified = date(time()); 
        }


        return true; // Validation successful
    }

    public function save() {
        $user  = $this->getUser();

        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);

        if (!empty($this->verified)) {
            $user->email_verified_at = $this->verified;
        }
        
        if ($user->save()) {
            return true;
        }
        return false;
    }
}