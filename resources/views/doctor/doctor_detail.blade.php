<section class="responsive-img" style=" background-image:url({{URL::asset('public')}}/assets/img/header.png);background-size: cover; background-attachment: fixed;">
        <div class="row" style=" margin-bottom:0px;">
            <div class="col s12 m6 l6" style=" height: 70vh; text-align:center;">
            <img style=" height: 70vh;" src="https://local.samitivejchonburi.com/gallery/doctor/resize_imgs/{{$img}}" class="responsive-img" alt="">
            </div>
            <div class="col s12 m6 l6 " style="height: 70vh; padding: 1%; background: rgb(245 245 245 / 89%);">
               <div class="" style="text-align: center;">
               <h4 id="name" style="color: rgb(0 71 41); ">{{$title}}{{ $name }} {{ $lastname }}</h4>
               </div>
               <div class="col s12 m6 l6" style="text-align: center;">
                <img style="width:150px;" class="responsive-img" src="{{URL::asset('public')}}/assets/img/medical/er.png" alt="">
               <h5 style="color: rgb(0 71 41); ">{{$description}}</h5>
               </div>
               <div class="col s12 m6 l6 lx6" style="text-align: left; border-left: 1px inset rgb(1, 134, 1);">
                {{-- <h5 class="col s1 m1 l1 lx1" style="color:rgb(0 71 41) ;"><i style="font-size:20px;" class="fa fa-asterisk " aria-hidden="true"></i></h5><h5 class="col s11 m11 l10" style="color:  rgb(0 71 41);">ศัลยแพทย์</h5>
                <h5 class="col s1 m1 l1 lx1" style="color:rgb(0 71 41) ;"><i style="font-size:20px;" class="fa fa-asterisk " aria-hidden="true"></i></h5><h5 class="col s11 m11 l10" style="color:  rgb(0 71 41);">เวชศาสตร์ฉุกเฉิน</h5>
                <h5 class="col s1 m1 l1 lx1" style="color:rgb(0 71 41) ;"><i style="font-size:20px;" class="fa fa-asterisk " aria-hidden="true"></i></h5><h5 class="col s11 m11 l10" style="color:  rgb(0 71 41);">เวชศาสตร์ครอบครัว</h5> --}}

               </div>
               <div class="col s12 m12 l12" style="text-align: center; margin-top:20px;">
                    <button class="btn-large waves-effect waves-light btn" style="background-color: rgb(0 71 41) ; width:60%;"><h6>นัดหมายแพทย์</h6></button>
               </div>
            </div>
        </div>
</section>
