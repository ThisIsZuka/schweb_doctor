<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/{id}','Maincontroller@view');

Route::get('/', function () {
    return view('doctor_search');
});

Route::get('doctor_search', function () {
    return view('doctor_search');
});

Route::get('header',function(){
    return view('header.header');
});

// ข้อมูลแสดงข้อมูลแพทย์ทั้งหมด
Route::post('Show_Data_ctls', 'Search_Controller@show_data_doctor');

Route::post('Show_Search_Data_ctls', 'Search_Controller@show_Search_data_doctor');

// ชื่อหมอสำหรับ search
Route::get('Get_NameDoctor_ctls', 'Search_Controller@name_doctor');

// ข้อมูลแผนก
Route::get('Get_location_ctls', 'Search_Controller@service_location');

// ข้อมูลความเชี่ยวชาญเฉพาะ
Route::get('Get_location_sub_ctls', 'Search_Controller@service_location_sub');

// count doctor
Route::post('Get_count_data_ctls', 'Search_Controller@Get_count_doctor');

// count doctor Search
Route::post('Get_count_data_search_ctls', 'Search_Controller@Get_count_search_doctor');






