<?php

namespace App\Http\ControllerS\API;

use App\Dao\LoginDao;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Functions\MessageExpiryFunction;
use App\Http\Controllers\Functions\RecoverPasswordFunction;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function authenticate(Request $request)
	{
		try{
			$user = User::where('user_name', $request->username)->first();
			if (! $user || ! Hash::check($request->password, $user->password)) {
			
				throw ValidationException::withMessages([
				'email' => ['The provided credentials are incorrect.'],]);
	
			}
			$token=$user->createToken($request->username)->plainTextToken;
			// return response()->json(['jwt'=>$token]);

			$roles=array();
			$authority=new LoginDao();
			$authority->setAuthority($user->role->role_name);
			$roles[0]=$authority;
			if(strcasecmp($user->role->role_name,"ROLE_ADMIN")==0) {
				return response()->json([
					'jwt'=>$token,
					'roles'=>$roles,
					'id'=>$user->id,
					'userName'=>$user->user_name,
					'name'=>$user->name,
					'expiryMessage'=>""
				],200);
				
			}else {
				$expiry=$user->expiry_date;
				if( $expiry>now() && $user->active==true) {
					
					$msg=MessageExpiryFunction::messageExpiry($expiry);
					return response()->json([
						'jwt'=>$token,
						'roles'=>$roles,
						'id'=>$user->id,
						'userName'=>$user->user_name,
						'name'=>$user->name,
						'expiryMessage'=>$msg
					],200);
					
				}else {
					return response()->json('Su cuenta ha expirado',403);
					
				}
			}
		}catch(Exception $e){

			return response()->json('Username o password incorrecto',403);
		}
		
	}
    public function noExistsTelephone($telephone){

        //$result=true;
        $result='true';
    	$allUser = User::all();
		foreach($allUser as $a) {
			if($a->telephone!=0){
			if($a->telephone==$telephone && $a->active==true) {
				//$result=false;
                $result='false';
			}}
		}
		
		return $result;
    }

    public function recoverByPhone($telephone){

        $u=RecoverPasswordFunction::recover($telephone);
      
		if($u!=null) {
			return response()->json($u,201);
		}else {
			return response()->json("error",400);
		}
 
    }

    public function changePassword(Request $request){

        $user=User::find($request->idUser);
    	$user->password= bcrypt($request-> password);
        $user->save();	
    	return "Se cambio la contraseña";
    }

	public function logout(Request $request){

		$request->user()->currentAccessToken()->delete();
       	
    	return  response()->json("Se elimino el token",200);
    }
}
