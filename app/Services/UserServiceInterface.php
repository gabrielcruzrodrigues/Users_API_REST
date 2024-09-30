<?php

namespace App\Services;

use App\Http\Requests\UserFormRequest;
use App\Models\User;

interface UserServiceInterface 
{
     public function GetAll();
     public function Create(UserFormRequest $request);
     public function Update(UserFormRequest $request, User $user);
}