<?php

namespace App\Http\Controllers\API;

use App\Dao\SettingDao;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Exception;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function updateWelcomeMessage(Request $request) {
		
	    $s=Setting::find(1);
		$s->welcome_message=$request->welcomeMessage;
		$s->save();
		return "Se actualizó el mensaje de bienvenida";
	}
	
   public function updateImage(Request $request) {
		
		$s=Setting::find(1);
        $image=$request->file->store('\public\uploads');
		try {
			$s->image=$image->getBytes();
			$s->save();
		} catch (Exception $e) {
			return $e;
		}
		return "Se actualizó la imagen";
	}
    
   
    public function getSetting() {
        $s=Setting::find(1);
        $setting=new SettingDao();
        $setting->idSetting=$s->id;
        $setting->welcomeMessage=$s->welcome_message;
        $setting->image=$s->image;
        //>json(Employee::find(202), 200, [], JSON_UNESCAPED_UNICODE); 
      //  json_encode(
          //JSON_INVALID_UTF8_SUBSTITUTE
        //return  response()->json($setting);
		return response()->json($setting,200, [],  JSON_INVALID_UTF8_IGNORE );
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $s=Setting::find(1);
        

	// 	if(!empty($request->image)){
    //         $path=$request->image->store('public/logo');
    //         $url=Storage::url($path);
    //         $url='AccountSystem/public'.$url;
    //         $s->image=$url;
    //         $s->save();
    //         return "Se actualizó la imagen";
    //     }else{
    //         return "No se actualizó la imagen";
    //     }
	
    // }
    public function store(Request $request)
    {
        $s=Setting::find(1);

		if(!empty($request->image)){
            $path = $request->file('image')->getRealPath();
            $logo = file_get_contents($path);
            $base64 = base64_encode($logo);

            $s->image=$base64;
            $s->save();
            // $path=file_get_contents($request->image);
            // $s->image=$path;
            // $s->save();
            return "Se actualizó la imagen";
        }else{
            return "No se actualizó la imagen";
        }
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
