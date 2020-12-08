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
            ->select('ms_care.medical_id', 'forename', 'forename_en', 'surname', 'surname_en', 'parent_medical_center_id', 'titlename', 'doctor_img', 'ms_specialty.description')
            ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
            ->leftJoin('ms_doctor_specialty', 'ms_care.medical_id', '=', 'ms_doctor_specialty.id_doctor')
            ->leftJoin('ms_specialty', 'ms_doctor_specialty.id_specialty', '=', 'ms_specialty.uid')
            ->distinct('ms_care.medical_id')
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
        if ($data['text_Fname'] == '' && $data['text_location'] == '' && $data['text_location_sub'] == '') {
            $users = DB::table('ms_care')
                ->select('ms_care.medical_id', 'forename', 'forename_en', 'surname', 'surname_en', 'parent_medical_center_id', 'titlename', 'doctor_img', 'ms_specialty.description')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->leftJoin('ms_doctor_specialty', 'ms_care.medical_id', '=', 'ms_doctor_specialty.id_doctor')
                ->leftJoin('ms_specialty', 'ms_doctor_specialty.id_specialty', '=', 'ms_specialty.uid')
                ->orderBy('ms_care.uid', 'ASC')
                ->distinct('ms_care.medical_id')
                ->offset((int)$data['start'])
                ->limit((int)$data['end'])
                ->get();
        } else {
            $users = DB::table('ms_care')
                ->select('ms_care.medical_id', 'forename', 'forename_en', 'surname', 'surname_en', 'parent_medical_center_id', 'titlename', 'doctor_img', 'ms_specialty.description')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->leftJoin('ms_doctor_specialty', 'ms_care.medical_id', '=', 'ms_doctor_specialty.id_doctor')
                ->leftJoin('ms_specialty', 'ms_doctor_specialty.id_specialty', '=', 'ms_specialty.uid')
                ->leftJoin('ms_service_location', 'ms_care.parent_medical_center_id', '=', 'ms_service_location.code')
                // ->where(function ($query) use ($data){
                //         ->where('ms_care.forename', 'like', '%'.$data['text_Fname'].'%')
                //         ->orWhere('ms_care.forename', 'like', '%'.$data['text_Fname'].'%')
                //         ->orWhere('ms_care.surname', 'like', '%'.$data['text_Fname'].'%')
                //         ->orWhere('ms_care.surname', 'like', '%'.$data['text_Lname'].'%');
                //     })
                // ->orWhere('ms_care.parent_medical_center_id',"like", '%'.$data['text_location'].'%')
                // ->orWhere(' ms_specialty.uid',"like", '%'.$data['text_location_sub'].'%')
                ->where(function ($query) use ($data) {
                    if ($data['text_Fname'] != '') {
                        $query->where('ms_care.forename', 'like', '%' . $data['text_Fname'] . '%')
                            ->where('ms_care.surname', 'like', '%' . $data['text_Lname'] . '%');
                    }
                });
            if ($data['text_location'] != '') {
                $users->orWhere('ms_care.parent_medical_center_id', "like", '%' . $data['text_location'] . '%');
            }
            if ($data['text_location_sub'] != '') {
                $users->orWhere('ms_specialty.uid', "like", '%' . $data['text_location_sub'] . '%');
            }
            $users->orderBy('ms_care.uid', 'ASC')
                ->distinct('ms_care.medical_id')
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

    public function name_doctor()
    {
        $users = DB::table('ms_care')
            ->select('forename', 'surname', 'forename_en', 'surname_en', 'titlename')
            ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
            ->get();
        return json_encode($users);
    }

    public function service_location()
    {
        $users = DB::table('ms_service_location')
            ->select('*')
            ->where('status', '1')
            ->get();
        return json_encode($users);
    }

    public function service_location_sub()
    {
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

    public function Get_count_doctor(Request $request)
    {
        $data =  $request->all();
        if ($data['text_Fname'] == '' && $data['text_location'] == '' && $data['text_location_sub'] == '') {
            $users = DB::table('ms_care')
                ->select('ms_care.medical_id')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->leftJoin('ms_doctor_specialty', 'ms_care.medical_id', '=', 'ms_doctor_specialty.id_doctor')
                ->leftJoin('ms_specialty', 'ms_doctor_specialty.id_specialty', '=', 'ms_specialty.uid')
                ->distinct('ms_care.medical_id')
                ->get();
        } else {
            $users = DB::table('ms_care')
                ->select('ms_care.medical_id')
                ->leftJoin('ms_title', 'ms_care.ms_title_uid', '=', 'ms_title.uid')
                ->leftJoin('ms_doctor_specialty', 'ms_care.medical_id', '=', 'ms_doctor_specialty.id_doctor')
                ->leftJoin('ms_specialty', 'ms_doctor_specialty.id_specialty', '=', 'ms_specialty.uid')
                ->leftJoin('ms_service_location', 'ms_care.parent_medical_center_id', '=', 'ms_service_location.code')
                ->where(function ($query) use ($data) {
                    if ($data['text_Fname'] != '') {
                        $query->where('ms_care.forename', 'like', '%' . $data['text_Fname'] . '%')
                            ->where('ms_care.surname', 'like', '%' . $data['text_Lname'] . '%');
                    }
                });
            if ($data['text_location'] != '') {
                $users->orWhere('ms_care.parent_medical_center_id', "like", '%' . $data['text_location'] . '%');
            }
            if ($data['text_location_sub'] != '') {
                $users->orWhere('ms_specialty.uid', "like", '%' . $data['text_location_sub'] . '%');
            }
            $users->distinct('ms_care.medical_id');
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
