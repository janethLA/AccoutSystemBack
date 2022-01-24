<?php

namespace App\Http\Controllers\API;

use App\Dao\DataTotalDao;
use App\Dao\DataUserDao;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Dao\UserDao;
use App\Http\Controllers\Functions\UserFunction;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers =User::all();
	    $allUsersByOrder = collect([]);
		foreach($allUsers as $found) {
		
			if($found->active==true) {
				$newUser = new UserDao();
				$newUser->setIdUser($found->id);
				$newUser->setName($found->name);
				$newUser->setUsername($found->user_name);
				$newUser->setTelephone($found->telephone);
				$newUser->setExpiryDate($found->expiry_date);
				$newUser->setRegistrationDate($found->registration_date);
				//newUser.setPassword(found.getPassword());
				$allUsersByOrder->push($newUser);
              
			}
			
		}
        // return UserResource::collection(User::all());
        return $allUsersByOrder->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=new User();
        $user->name = $request->name;
        $user->user_name = $request->username;
        $user->password = bcrypt($request-> password);
        $user->telephone = $request->telephone;
        $user->expiry_date = $request->expiryDate;
        $user->registration_date=now();
        $user->active= true;
        $user->role_id=2;
        $user->save();
    }

    public function noExistsUserName($userName){

        $response ='true';
		$allUser = User::all();

        foreach ($allUser as $user) {
            if(strcasecmp($user->user_name, $userName) === 0) {
                $response='false';
			}
        }
        
		return $response;
    }

    public function setUser($id, Request $request){
        $user=User::find($id);
       
		if($request->name) {
            $user->name = $request->name;
		}
		if($request->password) {
			$user->password =  bcrypt($request-> password);
		}
		if($request->username) {
			$user->user_name = $request->username;
        }
		if($request->telephone) {
			$user->telephone = $request->telephone;
		}
		if($request->expiryDate) {
            $user->expiry_date = $request->expiryDate;
		}
		
        $user->save();
        return $user;

    }

    public function deleteUser($id){

        
    		$user=User::find($id);
            $role=$user->role;
    		if(strcasecmp($role->role_name,"ROLE_ADMIN")>0) {
    			$user->active=false;
        		$user->save();
        		return "Se dio de baja correctamente el usuario";
    		}else {
    			return "No se puede dar de baja al superusuario";
    		}

       
    }
    
    public function getIncomeAndExpenseTotalUser($id){
        $user=User::find($id);
    	$list=collect();
    	
    	$data=new DataTotalDao();
		$data->setName("TOTAL INGRESOS");
		$data->setTotal(UserFunction::getTotalIncomeUser($user));
		$data1=new DataTotalDao();
		$data1->setName("TOTAL EGRESOS");
		$data1->setTotal(UserFunction::getTotalExpenseUser($user));
		$data2=new DataTotalDao();
		$data2->setName("INGRESO");
		$data2->setTotal(UserFunction::getTotalIncomeAccount($user));
		$data3=new DataTotalDao();
		$data3->setName("EGRESO");
		$data3->setTotal(UserFunction::getTotalExpenseAccount($user));
		
		$list->push($data);
		$list->push($data1);
		$list->push($data2);
		$list->push($data3);
		
		return $list;
    }

    public function updateDataFinalUser($id, Request $request){

        $user=User::find($id);
		
        if($request->password) {
			$user->password =  bcrypt($request-> password);
		}
		if($request->username) {
			$user->user_name = $request->username;
        }
		if($request->telephone) {
			$user->telephone = $request->telephone;
		}
		
		$user->save();
		return $user;
    }
 
    public function getDataUser($id){
        $user=User::find($id);
    	$newUser=new DataUserDao();
    	$newUser->setUsername($user->user_name);
        $newUser->setName($user->name);
    	$newUser->setTelephone($user->telephone);
    	return response()->json($newUser);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
