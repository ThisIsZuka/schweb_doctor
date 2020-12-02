<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class Search_Controller extends Controller
{
    public function show_data_doctor(Request $request)
    {
        $data =  $request->all();
        // echo (int)$data['start'];
        $users = DB::table('ms_care')
                ->select('*')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->offset((int)$data['start'])
                ->limit((int)$data['end'])
                ->get();
        return json_encode($users);
    }

    public function show_Search_data_doctor(Request $request)
    {
        $data =  $request->all();
        // echo (int)$data['start'];
        // dd($data['text_location']);
        if($data['text_title'] == '' && $data['text_location'] == '' && $data['text_location_sub'] == ''){
            $users = DB::table('ms_care')
                ->select('*')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->offset((int)$data['start'])
                ->limit((int)$data['end'])
                ->get();
        }else{
            $users = DB::table('ms_care')
                ->select('*')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->leftJoin('ms_service_location', 'ms_care.parent_medical_center_id', '=', 'ms_service_location.code')
                ->leftJoin('ms_specialty', 'ms_care.parent_sub_specialty_id', '=', 'ms_specialty.uid')
                // ->where(function ($query) use ($data){
                //         ->where('ms_care.forename', 'like', '%'.$data['text_title'].'%')
                //         ->orWhere('ms_care.forename', 'like', '%'.$data['text_Fname'].'%')
                //         ->orWhere('ms_care.surname', 'like', '%'.$data['text_Fname'].'%')
                //         ->orWhere('ms_care.surname', 'like', '%'.$data['text_Lname'].'%');
                //     })
                // ->orWhere('ms_care.parent_medical_center_id',"like", '%'.$data['text_location'].'%')
                // ->orWhere('ms_care.parent_sub_specialty_id',"like", '%'.$data['text_location_sub'].'%')
                ->where(function ($query) use ($data){
                if($data['text_title'] != ''){
                    $query->where('ms_care.forename', 'like', '%'.$data['text_Fname'].'%')
                        ->orWhere('ms_care.surname', 'like', '%'.$data['text_Lname'].'%');
                }
                });
                if($data['text_location'] != ''){
                    $users->orWhere('ms_care.parent_medical_center_id',"like", '%'.$data['text_location'].'%');
                }
                if($data['text_location_sub'] != ''){
                    $users->orWhere('ms_care.parent_sub_specialty_id',"like", '%'.$data['text_location_sub'].'%');
                }
                $users->orderBy('ms_care.uid', 'ASC')
                    ->offset((int)$data['start'])
                    ->limit((int)$data['end']);

                $result = $users->get();
                return json_encode($result);
                // $queryS = str_replace(array('?'), array('\'%s\''), $users->toSql());
                // $queryS = vsprintf($queryS, $users->getBindings());
                // dump($queryS);
        }
        return json_encode($users);
    }

    public function name_doctor(){
        $users = DB::table('ms_care')
        ->select('forename','surname','forename_en','surname_en','titlename')
        ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
        ->get();
        return json_encode($users);
    }

    public function service_location(){
        $users = DB::table('ms_service_location')
        ->where('status','1')
        ->select('*')
        ->get();
        return json_encode($users);
    }

    public function service_location_sub(){
        $users = DB::table('ms_specialty')
        ->select('*')
        ->get();
        return json_encode($users);
    }

    // public function Get_count_doctor(){
    //     $users = DB::table('ms_care')
    //     ->select('*')
    //     ->get();
    //     $Count = count($users);
    //     return json_encode($Count);
    // }

    public function Get_count_doctor(Request $request){
        $data =  $request->all();
        if($data['text_title'] == '' && $data['text_location'] == '' && $data['text_location_sub'] == ''){
            $users = DB::table('ms_care')
                ->select('*')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->get();
        }else{
            $users = DB::table('ms_care')
                ->select('*')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->leftJoin('ms_service_location', 'ms_care.parent_medical_center_id', '=', 'ms_service_location.code')
                ->leftJoin('ms_specialty', 'ms_care.parent_sub_specialty_id', '=', 'ms_specialty.uid')
                ->where(function ($query) use ($data){
                if($data['text_title'] != ''){
                    $query->where('ms_care.forename', 'like', '%'.$data['text_Fname'].'%')
                        ->orWhere('ms_care.surname', 'like', '%'.$data['text_Lname'].'%');
                }
                });
                if($data['text_location'] != ''){
                    $users->orWhere('ms_care.parent_medical_center_id',"like", '%'.$data['text_location'].'%');
                }
                if($data['text_location_sub'] != ''){
                    $users->orWhere('ms_care.parent_sub_specialty_id',"like", '%'.$data['text_location_sub'].'%');
                }
            $result = $users->get();
            $Count = count($result);
            return json_encode($Count);
        }
        // $users = DB::table('ms_care')
        // ->select('*')
        // ->get();
        $Count = count($users);
        return json_encode($Count);
    }
}
