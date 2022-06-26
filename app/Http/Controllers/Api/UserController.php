<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
class UserController extends Controller
{

    public function index()
    {
        $users = UserResource::collection(User::paginate(10));
        
        return $users;
        //return response()->json(['users'=>$users],200);
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:50',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' =>false,
                'message' =>$validator->message
            ]) ;
        }
        $data = $request->only('name','email','password');
        $data['password'] =bcrypt($data['password']);
        User::create($data);
        return response()->json([
            'success' =>true,
            'message' =>'kaydedildi'
        ]) ;
    }

 
    public function show($id)
    {
        $user = new UserResource(User::find($id));
        return response()->json($user,200);
    }

 
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:50',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' =>false,
                'message' =>$validator->message
            ],422) ;
        }
        $data = $request->only('name','email','password');
        $data['password'] =bcrypt($data['password']);

        $user->update($data);
        return response()->json([
            'success' =>true,
            'message' =>'Güncellendi'
        ]) ;
    }

  
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'success' =>true,
            'message' =>'Silindi'
        ],200) ;
    }
    /*
        public function destroy(User $user)
    {
        
        $user->delete();
    }
    */
}
