<?php

namespace App\Http\Controllers;

use App\Item;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Maincontroller extends Controller
{
    public function view(Request $request,$iddoctor){

        $Datenow=Carbon::now()->toDateString();


        $data=DB::table('ms_care')
        ->join('ms_title_doctor','ms_care.ms_title_uid','ms_title_doctor.ms_title_code')
        ->join('ms_doctor_specialty','ms_care.medical_id','ms_doctor_specialty.id_doctor')
        ->join('ms_specialty','ms_doctor_specialty.id_specialty','ms_specialty.uid')
        ->join('ms_careprovider','ms_care.uid','ms_careprovider.ms_doctor_uid')
        ->where('ms_care.uid','=',$iddoctor)
        ->get();
        
        $headurlapi="https://sch.telecorpthailand.com/";

        $doctor=([
            'ms_doctor_uid'=>$data[0]->ms_doctor_uid,
            'ms_location_id'=>$data[0]->ms_location_id,
            'img'=>$data[0]->doctor_img,
            'title'=>$data[0]->title,
            'forename'=>$data[0]->forename,
            'lastname'=>$data[0]->surname,
            'sex'=>$data[0]->gender,
            'education'=>$data[0]->education,
            'language'=>$data[0]->language,
            'description'=>$data[0]->description,
            'Datenow'=>$Datenow,
            'headurlapi'=>$headurlapi

        ]);

        //  database 2 บทความแพทย์
        $blogdoctor = DB::connection('mysql2')->table('tb_promotion')->where('id_doctor','=',$data[0]->ms_doctor_uid)->get();

       $blog='';
       $blogbig='';
       $blogbig.='
            <div class="img-overlay-70  img-scale-animate mb-2" style=" background-image: url(); height: 450px;">
                <img src="https://www.samitivejchonburi.com/images/content/blobid1604250540040.png" alt="news" class="bg-pan-tr" style="width: 100%;">
            <div class="mask-content-lg" style="">
                <div class="topic-box-sm color-cinnabar mb-20"></div>
                <div class="post-date-light">
                    <ul>
                        <li>
                            <span>by</span>
                            <a href="single-news-1.html">'.$doctor['title'].''.$doctor['forename'].' '.$doctor['lastname'].'</a>
                        </li>
                        <li>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span></li>
                    </ul>
                </div>
                <h3 class="title-medium-light" style="background-color:#00000040; height: 79px;">
                    <a style="color:white;" href="single-news-1.html">'.$blogdoctor[0]->promotion_name.'</a>
                </h3>
            </div>
        </div>
        </div>
            ';

       foreach($blogdoctor AS $data){
            
            $blog.='
            <div class="col s12 m6 l6 xl6">
            <div class="card horizontal">
              <div class="card-image">
                <img src="https://www.samitivejchonburi.com/images/promotion/'.$data->promotion_image.'">
              </div>
              <div class="card-stacked">
                <div class="card-content">
                  <p>'.$data->promotion_name.'</p>
                </div>
                <div class="card-action">
                  <a href="https://www.samitivejchonburi.com/promotiondetail.php?id='.$data->promotion_id.'&did='.$data->id_doctor.'">อ่านเพิ่มเติม</a>
                </div>
              </div>
            </div>
          </div>
            ';
       }
             // <div id="'.$data->promotion_id.'" doctorid="'.$data->id_doctor.'"  style="margin: 15px;" class="card horizontal col s12 m3 l3 xl3">
            //     <div class="card-image">
            //         <img src="https://www.samitivejchonburi.com/images/promotion/'.$data->promotion_image.'">
            //     </div>
            //     <div class="card-stacked">
            //         <div class="card-content">
            //              <h4>'.$data->promotion_name.'</h4>
            //             <p>I am a very simple card. I am good at containing small bits of information.</p>
            //         </div>
            //         <div class="card-action">
            //             <a href="#">ดูเพิ่มเติม</a>
            //         </div>
            //     </div>
            // </div>
        // dd($blogdoctor);
        // dd($doctor);
        return view('index' 
        ,[
        'headurlapi'=>$doctor['headurlapi'],
        'ms_doctor_uid'=>$doctor['ms_doctor_uid'],
        'ms_location_id'=>$doctor['ms_location_id'],
        'Datenow'=>$doctor['Datenow'],
        'title'=>$doctor['title'],
        'name'=>$doctor['forename'],
        'lastname'=>$doctor['lastname'],
        'img'=>$doctor['img'],
        'description'=>$doctor['description'],
        'education'=>$doctor['education'],
        'blog'=>$blog,
        'blogbig'=>$blogbig]);
    }
}
