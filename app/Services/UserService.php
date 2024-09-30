<?php

namespace App\Services;

use App\Exceptions\DatabaseExeption;
use App\Exceptions\UserAlreadyExistsException;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\UserServiceInterface;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
     public function GetAll()
     {    
          return User::orderBy('id', 'ASC')->paginate(5);
     }

     public function Create(UserFormRequest $request)
     {
          DB::beginTransaction();

          try 
          {
               User::create($request->all());
               DB::commit();
          }
          catch(QueryException $ex)
          {
               DB::rollback();

               if ($ex->getCode() === '23000')
               {
                    throw new UserAlreadyExistsException();
               }

               throw new DatabaseExeption();
          }
          catch(Exception $ex)
          {
               DB::rollBack();
               throw new Exception("An error occurred when trying to create the new user");
          }
     }

     public function Update(UserFormRequest $request, User $user)
     {
          DB::beginTransaction();
          try 
          {
               $user->update($request->all());
               DB::commit();
          }
          catch(Exception $ex)
          {
               DB::rollBack();
               throw new DatabaseExeption();
          }
     }
}