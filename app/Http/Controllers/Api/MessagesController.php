<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    public $message ;

    public function __construct(Message $message)
    {
        $this->message = $message ;
    }

    public function send(Request $request){
     // dd($request);
      $validation = Validator::make($request->all(),[
        'user_id'=> 'required',
        'to_user'=> 'required',
        'message'=> 'required',
      ]);
      if($validation ->fails()){
        return response()->json([
            'status'=> false ,'error'=>$validation->errors()
        ]);
      }

      $to_user = User::find($request->to_user);
      if(!$to_user){
          return response()->json(['status'=>false ,'error'=>'user not found']);
      }
      $data = $this->message->create([
         'user_id'=>$request->user_id,
         'to_user'=>$request->to_user,
         'message'=>$request->message
      ]);

      if($data){
        return response()->json(['status'=>true ,'data'=>$data]);
      }
      return response()->json(['status'=>false]);
    }


    public function messages($id){
        $to_user = User::findOrFail($id);
        if(!$to_user){
          return response()->json(['staus'=>false , 'error'=> 'error user ' ]);
        }
        $messages = $this->message->where('user_id',9)
        ->where('to_user',"=",$to_user->id)->orWhere('user_id',8)->get();
      
        return response()->json(['data'=>MessageResource::collection($messages),'status'=>true]);

       
    }
}
