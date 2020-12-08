
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$title}}{{ $name }} {{ $lastname }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
        {{-- icon title --}}
        <link rel="icon" href="{{asset('public')}}/assets/logo/logo.png" type="image/gif" sizes="16x16">
        <!-- font-awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
         <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        {{-- bloghealty --}}
        <link rel="stylesheet" href="{{asset('public')}}/css/bloghealty/slide.css">
    </head>
    <body style="overflow: auto;">
        @include('header.header')
        {{-- <div style="overflow: auto; height:100vh;"> --}}
            @include('doctor.doctor_detail')
            @include('doctor.doctor_blog')
            @include('doctor.doctor_calenda')
            @include('doctor.doctor_bloghealty')          
        {{-- </div> --}}
    </body>
</html>
 <!-- Compiled and minified JavaScript -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{URL::asset('public')}}/js/calenda/calenda.js"></script>
<script>
    $(document).ready(function(){
     $('.sidenav').sidenav();
     $('.tooltipped').tooltip();
     $('#table').addClass("progress")
     $('#slots').addClass("indeterminate")
     $.ajax({
            url:'{{$headurlapi}}Appointment?Location_ID={{$ms_location_id}}&CareProvider_ID={{$ms_doctor_uid}}&Date={{$Datenow}}',
            type:'get',
            success :function (data) { 
                $('#table').removeClass("progress")
                $('#slots').removeClass("indeterminate") 
                console.log(data)
                var day = data[0].session_Date;
                var dayis = new Date(day);
                var weekday = new Array(7);
                weekday[0] = "อาทิตย์";
                weekday[1] = "จันทร์";
                weekday[2] = "อังคาร";
                weekday[3] = "พุทธ";
                weekday[4] = "พฤหัส";
                weekday[5] = "ศุกร์";
                weekday[6] = "เสาร์";
                var today = weekday[dayis.getDay()]
                $('#Day').html("วัน"+today)
                $('#subDay').html(day)
                var i;
                var slot;
                for(i=0; i<data[0].slots.length; i++){
                   var slot = data[0].slots[i]
                   var slotstart =data[0].slots[i].slot_Start;
                   var slotend =data[0].slots[i].slot_End;
                }
                $('#slots').append("<tr><td>"+data[0].session_Start_Time+"<td>"+data[0].session_End_Time+"</td></td></tr>")
            },
            404:function(data){
                $('#slots').html("<tr><td>"+"ไม่มีข้อมูลตารางออกตรวจวันนี้"+"<td>"+"ไม่มีข้อมูลตารางออกตรวจวันนี้"+"</td></td></tr>")
            }
        })
    $('div .day').on('click',function(){
        
        $('#table').addClass("progress");
        $('#slots').addClass("indeterminate");
         var day = $('#monthAndYear').text()+"-"+$(this).text();
         var url = "{{$headurlapi}}Appointment?Location_ID={{$ms_location_id}}&CareProvider_ID={{$ms_doctor_uid}}&Date="+day
        //  alert(encodeURIComponent(url))
         $.ajax({
            url:url,
            type:'get',
            success:function(data){
                console.log(data[0].slots)
                var dayis = new Date(day);
                var weekday = new Array(7);
                weekday[0] = "อาทิตย์";
                weekday[1] = "จันทร์";
                weekday[2] = "อังคาร";
                weekday[3] = "พุทธ";
                weekday[4] = "พฤหัส";
                weekday[5] = "ศุกร์";
                weekday[6] = "เสาร์";
                var today = weekday[dayis.getDay()]
                $('#Day').html("วัน"+today)
                $('#subDay').html(day)
                if(data[0].slots===null){
                    // alert("ไม่เข้าเงื่อนไข")
                    $('#slots').html("<tr><td>"+"ไม่มีข้อมูลตารางออกตรวจวันนี้"+"<td>"+"ไม่มีข้อมูลตารางออกตรวจวันนี้"+"</td></td></tr>")
                }else{
                $('#slots').html("")
                var i;
                var slot;
                    for(i=0; data[0].slots.length>i; i++){
                    var slot = data[0].slots[i]
                    var slotstart =data[0].slots[i].slot_Start;
                    var slotend =data[0].slots[i].slot_End;
                    }
                    $('#slots').append("<tr><td>"+data[0].session_Start_Time+"<td>"+data[0].session_End_Time+"</td></td></tr>")
                }
                $('#table').removeClass("progress")
                $('#slots').removeClass("indeterminate") 
            },
            404:function(data){
                $('#slots').html("<tr><td>"+"ไม่มีข้อมูลตารางออกตรวจวันนี้"+"<td>"+"ไม่มีข้อมูลตารางออกตรวจวันนี้"+"</td></td></tr>")
            }
        })
    })
});

</script>
