<?php

namespace App\Http\Controllers;
use App\Models\UserCourse;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Traits\ApiResponser;

Class UserController extends Controller {
    use ApiResponser;

    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }
    public function index(){
        $users = User::all();
        return $this->successResponse($users);
    }
    
    public function add(Request $request ){
        
        $rules = [
            'BookID' => 'numeric|min:1|not_in:0',
            'BookName' => 'required|max:150',
            'YearPublish' => 'required|numeric|min:1|not_in:0',
            'AuthorID' => 'required|numeric|min:1|not_in:0',
        ];
        
        $this->validate($request,$rules);
        $user = User::create($request->all());

        return $this->successResponse($user,Response::HTTP_CREATED);
    }

    public function show($BookID){

        $user = User::findOrFail($BookID);
        return $this->successResponse($user);
    }

    public function update(Request $request,$BookID){

        $rules = [
            'BookID' => 'required|numeric|min:1|not_in:0',
            'BookName' => 'required|max:150',
            'YearPublish' => 'required|numeric|min:1|not_in:0',
            'AuthorID' => 'required|numeric|min:1|not_in:0',
        ];
    
        $this->validate($request, $rules);
        $user = User::findOrFail($BookID);
        $user->fill($request->all());
        
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must
            change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $user->save();
        return $this->successResponse($user);
    }

    public function delete($BookID){
        
        $user = User::findOrFail($BookID);
        $user->delete();
        
        return $this->successResponse($user);
    }
}