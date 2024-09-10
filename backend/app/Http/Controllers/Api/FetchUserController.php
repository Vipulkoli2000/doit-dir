<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\FetchUserController;

class FetchUserController extends BaseController
{
    public function index(){

        $users = User::all();

        return response()->json([
            'message' => count($users),
            'data' => $users,
            'status' => true
        ]);

    }

    public function deleteUser($id): JsonResponse
    {
        $users = User::find($id);
        
        if(!$users){
        return $this->sendError('User no found', ['error'=>'User not found' ]);
    }
    $user = Auth::user();
    if($user->profile->id !== $users->profile_id){
        return $this->sendError('Unauthorized',['error' =>'You are not allowed to access this Users' ]);
    }

    $users->delete();

    return $this->sendResponse([], 'Users deleted successfully');

    }
}