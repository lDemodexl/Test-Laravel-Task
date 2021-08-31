<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\domains;
use Cookie;
use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\QueryException;

class IpCheckerTool extends Controller
{
    public function index(Request $request){

        $cookie_user_uid = Cookie::get('user_uid');

        return view('public.home', compact('cookie_user_uid'));
    }

    public function addList(Request $request){
        if( !empty($request->domains) ){
            $user_uid = $request->cookie('user_uid');
            $data = array();
            foreach( json_decode($request->domains) as $domain ){
                array_push($data, array( 'domain'=> $domain, 'user_uid' => $user_uid, 'created_at' => Carbon::now()));
            }
            try{
            domains::insert($data);
            }catch (Illuminate\Database\QueryException $e) {
                dd($e);

            }catch (PDOException $e) {
                dd($e);

            }catch (Exception $e){
                if( get_class($e) == 'Illuminate\Database\QueryException' ){
                    echo json_encode(array(
                        'status' => 'error',
                        'msg' => 'Database error! Check maybe you had already add this domains to list.'
                    ));
                    die();
                }

            }
            echo json_encode(array(
                'status' => 'success'
            ));
        }else{
            echo 'Error: Empty List';
        }
    }

    public function history(Request $request){
        $user_uid = $request->cookie('user_uid');
        $records = domains::where('user_uid', $user_uid)->orderByDesc('created_at')->get();
        return view('public.history', compact('records'));
    }
}
