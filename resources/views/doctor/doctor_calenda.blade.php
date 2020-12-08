<link rel="stylesheet" href="{{URL::asset('public')}}/css/calenda/calenda.css"  crossorigin="anonymous">
<section id="calenda" style="height:auto; padding:1%; padding-bottom: 3%; background-image: linear-gradient(to right top, #fffcf6, #fffcf9, #fffcfc, #fffdfe, #fffeff, #fcfcfd, #f9f9fc, #f5f7fa, #ebf2f5, #e1edee, #d9e8e4, #d6e2d8);">
        <div class="row" >
            <div class="col s12 m12 l12 xl12">
                <h3 style="color:#b18e50;">ตารางออกตรวจของแพทย์</h3>
                เลือกวัน ที่ระบุไว้ในปฎิทิน เพื่อดูตารางเวลาและสาขา สำหรับการนัดหมาย
                *กรุณาทำการนัดหมายแพทย์ล่วงหน้าอย่างน้อย 1 วัน
            </div>
            <div class="col s12 m6 l6 xl6">
               
                <div class="card">
                    <h4 class="card-header" style="padding:15px; background-image: linear-gradient(to right, #b18e50, #b59356, #b9975b, #be9c61, #c2a167, #c5a56d, #c9aa72, #ccae78, #d0b37f, #d4b886, #d8bd8e, #dcc295);"  id="monthAndYear"></h4>
                    <table class="table table-bordered table-responsive-sm" id="calendar">
                        <thead>
                        <tr>
                            <th>อาทิตย์</th>
                            <th>จันทร์</th>
                            <th>อังคาร</th>
                            <th>พุทธ</th>
                            <th>พฤหัส</th>
                            <th>ศุกร์</th>
                            <th>เสาร์</th>
                        </tr>
                        </thead>
                    
                        <tbody id="calendar-body">
                             
                        </tbody>
                        
                    </table>

                    <div class="container" style="text-align:center !important; margin-top: 3%;">
                        <div class="row">
                        <button class="btn   col s6  m6 l6 xl6" id="previous" style="background-color: rgb(0 71 41); " onclick="previous()">ย้อนกลับ</button>
                        <button class="btn   col s6  m6 l6 xl6" id="next" style="background-color: rgb(0 71 41);" onclick="next()">ถัดไป</button>
                    </div>
                    </div>
                    <br/>
                    <form class="form-inline">
                        <label class="lead mr-2 ml-2" for="month"></label>
                        <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                            <option value=01>มกราคม</option>
                            <option value=02>กุมภาพันธ์</option>
                            <option value=03>มีนาคม</option>
                            <option value=04>เมษายน</option>
                            <option value=05>May</option>
                            <option value=06>Jun</option>
                            <option value=07>Jul</option>
                            <option value=08>Aug</option>
                            <option value=09>Sep</option>
                            <option value=10>Oct</option>
                            <option value=11>Nov</option>
                            <option value=12>Dec</option>
                        </select>
                        <label for="year"></label><select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
                        <option value=1990>1990</option>
                        <option value=1991>1991</option>
                        <option value=1992>1992</option>
                        <option value=1993>1993</option>
                        <option value=1994>1994</option>
                        <option value=1995>1995</option>
                        <option value=1996>1996</option>
                        <option value=1997>1997</option>
                        <option value=1998>1998</option>
                        <option value=1999>1999</option>
                        <option value=2000>2000</option>
                        <option value=2001>2001</option>
                        <option value=2002>2002</option>
                        <option value=2003>2003</option>
                        <option value=2004>2004</option>
                        <option value=2005>2005</option>
                        <option value=2006>2006</option>
                        <option value=2007>2007</option>
                        <option value=2008>2008</option>
                        <option value=2009>2009</option>
                        <option value=2010>2010</option>
                        <option value=2011>2011</option>
                        <option value=2012>2012</option>
                        <option value=2013>2013</option>
                        <option value=2014>2014</option>
                        <option value=2015>2015</option>
                        <option value=2016>2016</option>
                        <option value=2017>2017</option>
                        <option value=2018>2018</option>
                        <option value=2019>2019</option>
                        <option value=2020>2020</option>
                        <option value=2021>2021</option>
                        <option value=2022>2022</option>
                        <option value=2023>2023</option>
                        <option value=2024>2024</option>
                        <option value=2025>2025</option>
                        <option value=2026>2026</option>
                        <option value=2027>2027</option>
                        <option value=2028>2028</option>
                        <option value=2029>2029</option>
                        <option value=2030>2030</option>
                    </select>
                </form>
                </div>
            </div>
            <div class="col s12 m6 l6 xl6" style="margin-top:1.5%;">
                <div class="row">
                    <div class="col s12 m12 l12 xl12" style="background-color: #c1a573;height: auto; text-align: center;
                    ">
                        <div  class="col s12 m12 l12 xl12">
                            <h5 style="color:white;" id="Day"> </h5>
                            <p id="subDay"></p>
                        </div>
                        <div  class="" style="text-align: center;"> 
                        {{-- <img src="https://local.samitivejchonburi.com/gallery/doctor/resize_imgs/{{$img}}" style="width:auto; height:250px;" alt=""> --}}
                       
                        </div>
                    </div>
                    
                    <div class="col s12 m12 l12 xl12"  style="height:auto; overflow:auto; background-color: #ebebeb6b;">
                        <table id="table" class="highlight">
                            <thead>
                              <tr>
                                  <th>เวลา-เริ่มออกตรวจ</th>
                                  <th>เวลา-สิ้นสุดออกตรวจ</th>
                                  {{-- <th>Item Price</th> --}}
                              </tr>
                            </thead>
                            <tbody id="slots">
                              <tr>
                            
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="col s12 m12 l12 xl12">
                   <a href="https://reg.samitivejchonburi.com/#profile"> <button class="col s6 btn-large waves-effect waves-light btn tooltipped" data-tooltip="คลิกเพื่อนัดหมายสำหรับผู้ป่วยใหม่"  style="background-color: rgb(1 95 55);">นัดหมายแพทย์สำหรับผู้ป่วยใหม่</button></a>
                    <button class="col s6 btn-large waves-effect waves-light btn tooltipped" data-tooltip="คลิกเพื่อนัดหมายสำหรับผู้ป่วยเก่า" style="background-color: rgb(1 95 55);">นัดหมายแพทย์สำหรับผู้ป่วยเก่า</button>
                </div>
            </div>
          </div>
        </div>
</section>

<script>
 
</script>

