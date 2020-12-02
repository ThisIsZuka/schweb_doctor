$(document).ready(function() {

    var datatable;
    var sum;
    var current_doc;
    var total_doc;
    var start;
    var end;

    // ค่าการค้นหา
    var text_title = "";
    var text_Fname = "";
    var text_Lname = "";
    var text_location = "";
    var text_location_sub = "";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //card slider
    var mySwiper = new Swiper('.swiper-container', {
        init: false,
        effect: 'coverflow',
    });
    // mySwiper.on('init', function() { /* do something */ });
    // // init Swiper
    // mySwiper.init();

    const button = document.getElementById('clear')
    const myInput = document.getElementById('autocomplete')

    myInput.addEventListener('input', function() {
        if (this.value != "") button.style.opacity = 1
        else button.style.opacity = 0
    });

    button.addEventListener('click', function() {
        myInput.value = "";
        this.style.opacity = 0
    });


    // กำหนดข้อมูล Card ของแต่ล่ะขนาดหน้าจอ
    var width = $(window).width();
    if (width >= 1400) {
        start = 0;
        end = 6;
        load_data_FirstCome();
    } else if (width < 1400 && width > 900) {
        start = 0;
        end = 4;
        load_data_FirstCome();
    } else if (width <= 900) {
        start = 0;
        end = 1;
        load_data_FirstCome();
    }
    $(window).resize(function() {
        var width = $(window).width();
        if (width >= 1400) {
            start = 0;
            end = 6;
            load_data_FirstCome();
        } else if (width < 1400 && width > 900) {
            start = 0;
            end = 4;
            load_data_FirstCome();
        } else if (width <= 900) {
            start = 0;
            end = 1;
            load_data_FirstCome();
        }
    });



    // โหลดข้อมูลแพทย์เมื่อเปิด
    // load_data_FirstCome();

    $('#loader').show();
    $('.swiper-container').hide();

    function load_data_FirstCome() {

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: "Show_Data_ctls",
            data: {
                start: start,
                end: end,
                _token: _token
            },
            dataType: "json",
            success: function(response) {
                datatable = response;
                var html = '';
                var i;
                var count;
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        count = i;
                        if (i == 0) {
                            html += '<div class="swiper-slide">' +
                                '<main class="page-content">';
                        }

                        if (i != 0 && i % (end / 2) == 0) {
                            html += '</div>';
                            if (i % end == 0) {
                                html += '</main>' +
                                    '</div>';
                            }
                        }

                        if (i % (end / 2) == 0 || i == 0) {
                            if (i % end == 0 && i != 0) {
                                html += '<div class="swiper-slide">' +
                                    '<main class="page-content">';
                            }
                            html += '<div class="row">';
                        }

                        html += '<div class="col">' +
                            '<div class="card card-doctor" style="background-image: url(\'Image/doctor.jpg\');">' +
                            '<div class="content">' +
                            ' <h2 class="title-card-doctor">' + response[i].titlename + response[i].forename + " " + response[i].surname + '</h2>' +
                            ' <p class="copy">Check </p>' +
                            ' <button class="btn">View Trips</button>' +
                            ' </div>' +
                            '</div>' +
                            '</div>';
                    }
                }
                // console.log(html)
                $('#show_data_card_pc').html(html);
                // M.AutoInit();
                var mySwiper = new Swiper('.swiper-container', {
                    // ...
                });
                current = 1;
                load_swiper(current, end);
                page_sum(current, end);
                $('#loader').hide();
                $('.swiper-container').show();
            }
        });
    }

    // โหลดข้อมูลแพทย์เมื่อมีการเปลี่ยนหน้าหรือค้นหาข้อมูล
    function load_data_page() {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: "Show_Search_Data_ctls",
            data: {
                start: start,
                end: end,
                text_title: text_title,
                text_Fname: text_Fname,
                text_Lname: text_Lname,
                text_location: text_location,
                text_location_sub: text_location_sub,
                _token: _token
            },
            dataType: "json",
            success: function(response) {
                datatable = response;
                var html = '';
                var i;
                var count;
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        count = i;
                        if (i == 0) {
                            html += '<div class="swiper-slide">' +
                                '<main class="page-content">';
                        }

                        if (i != 0 && i % (end / 2) == 0) {
                            html += '</div>';
                            if (i % end == 0) {
                                html += '</main>' +
                                    '</div>';
                            }
                        }

                        if (i % (end / 2) == 0 || i == 0) {
                            if (i % end == 0 && i != 0) {
                                html += '<div class="swiper-slide">' +
                                    '<main class="page-content">';
                            }
                            html += '<div class="row">';
                        }

                        html += '<div class="col">' +
                            '<div class="card card-doctor" style="background-image: url(\'Image/doctor.jpg\');">' +
                            '<div class="content">' +
                            ' <h2 class="title-card-doctor">' + response[i].titlename + response[i].forename + " " + response[i].surname + '</h2>' +
                            ' <p class="copy">Check </p>' +
                            ' <button class="btn">View Trips</button>' +
                            ' </div>' +
                            '</div>' +
                            '</div>';
                    }
                }
                // console.log(html)
                var mySwiper = new Swiper('.swiper-container', {
                    // ...
                });
                $('#show_data_card_pc').html(html);
                current = start;
                if (current == 0) {
                    current = 1;
                }
                load_swiper(current, end);
                // page_sum(current, end);

                // $([document.documentElement, document.body]).animate({
                //     scrollTop: $("#show_data_card_pc").offset().top
                // }, 2000);

            }
        });
    }


    // โหลดข้อมูลแผนก
    load_location()

    function load_location() {
        $.ajax({
            url: 'Get_location_ctls',
            dataType: "json",
            success: function(response) {
                var html = "";
                html += '<option value="" disabled selected>ค้นหาจากแผนก</option>';
                html += '<option value="" >ค้นหาจากแผนกทั้งหมด</option>';
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        var url_img = "{{ URL::asset('Image/Icon/bootstdssdrap.js') }}";
                        html += ' <option value="' + response[i].code + '" data-icon="Image/Icon/' + response[i].medical_center_icon + '"> ' + response[i].description_th + '</option>';

                    }
                    $('#select_location').html(html);
                }
                $('#select_location').formSelect();
            }
        });
    }

    // โหลดข้อมูลความเชี่ยวชาญ
    load_location_sub();

    function load_location_sub() {
        $.ajax({
            url: 'Get_location_sub_ctls',
            dataType: "json",
            success: function(response) {
                var html = "";
                html += '<option value="" disabled selected>ค้นหาจากสาขาความเชี่ยวชาญ</option>';
                html += '<option value="" >ค้นหาจากสาขาความเชี่ยวชาญทั้งหมด</option>';
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        html += '<option value="' + response[i].uid + '">' + response[i].description + '</option>';
                    }
                    $('#select_location_sub').html(html);
                }
                $('#select_location_sub').formSelect();
            }
        });
    }


    // โหลดข้อมูลแพทย์สำหรับ auto search
    load_nameDoctor();

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('#autocomplete');
        var instances = M.Autocomplete.init(elems, options);
    });


    // โหลดชื่อแพทย์ในการแสดงผล
    function load_nameDoctor() {
        $.ajax({
            url: "Get_NameDoctor_ctls",
            dataType: "json",
            success: function(response) {
                var dataCountry = {};
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        // options.push(response[i].titlename + " " + response[i].forename + " " + response[i].surname);
                        if (response[i].titlename != null) {
                            name = (response[i].titlename + " " + response[i].forename + " " + response[i].surname);
                        } else {
                            name = (response[i].forename + " " + response[i].surname);
                        }

                        dataCountry[name] = null;
                    }
                }
                // console.log(dataCountry);
                $('#autocomplete').autocomplete({
                    data: dataCountry,
                    // limit: 10,
                });
                // $("#autocomplete").autocomplete({
                //     source: options
                // });
                // $("#autocomplete").autocomplete({
                //     source: function(request, response) {
                //         var results = $.ui.autocomplete.filter(options, request.term);
                //         response(results.slice(0, 10));
                //     },
                // });
            }
        });
    }


    // เซ็ตจำนวนหน้าสไลด์ข้อมูลแพทย์
    function load_swiper(current, sum) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: 'Get_count_data_ctls',
            data: {
                text_title: text_title,
                text_Fname: text_Fname,
                text_Lname: text_Lname,
                text_location: text_location,
                text_location_sub: text_location_sub,
                _token: _token
            },
            dataType: "json",
            success: function(response) {
                var swiper = new Swiper('.swiper-container', {
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'custom',
                        renderCustom: function(swiper, current, total) {

                            total = (response / sum);
                            total = Math.ceil(total);
                            total_doc = total;
                            current_doc = current;
                            // return (current + ' of ' + total)
                            // return ('0' + current).slice(-2) + ' of ' + ('0' + total).slice(-2);
                        }
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    direction: 'horizontal',
                    loop: true,
                    slidesPerView: 1,
                    spaceBetween: 0,
                    mousewheel: false,
                    renderCustom: function(swiper, current, total) {
                        return current + ' of ' + total;
                    }
                });
            }
        });
    }

    // ข้อมูลจำนวนหน้าทั้งหมด
    function page_sum(current, sum) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: 'Get_count_data_ctls',
            data: {
                text_title: text_title,
                text_Fname: text_Fname,
                text_Lname: text_Lname,
                text_location: text_location,
                text_location_sub: text_location_sub,
                _token: _token
            },
            dataType: "json",
            success: function(response) {
                $('#sum_doctor').text(response)
                page_end = (response / sum)
                page_end = Math.ceil(page_end);
                $('#page_end').text(page_end);
                $('#page_now').text(current);
                if (current == page_end) {
                    $('.swiper-button-next').hide();
                } else {
                    $('.swiper-button-next').show();
                }
            }
        });
    }

    // ปุ่ม next
    $('.swiper-button-next').click(function(e) {
        e.preventDefault();
        slide_next()
    });


    $('.swiper-button-prev').hide();

    // ปุ่ม prev
    $('.swiper-button-prev').click(function(e) {
        e.preventDefault();
        silde_prev()
    });

    // clear input value
    $('#clear').click(function() {
        text_title = "";
        text_Fname = "";
        text_Lname = "";
        start = 0;
        load_data_page();
        current = 1;
        load_swiper(current, end);
        page_sum(current, end);
    })

    // mySwiper.on('transitionStart', function() {
    //     console.log('slide_next');
    //     slide_next();
    // });

    // mySwiper.on('transitionEnd', function() {
    //     console.log('silde_prev');
    //     silde_prev();
    // });


    function slide_next() {
        page_end = parseInt($('#page_end').text());
        page_now = parseInt($('#page_now').text());
        if ((page_now + 1) >= page_end) {
            $('.swiper-button-next').hide();
            $('.swiper-button-prev').show();
            $('#page_now').text(page_now + 1);
            start = (page_now * end);
            load_data_page();
            load_swiper(current, end);
        } else {
            $('.swiper-button-next').show();
            $('.swiper-button-prev').show();
            start = (page_now * end);
            $('#page_now').text(page_now + 1);
            load_data_page();
            load_swiper(current, end);
        }
    }

    function silde_prev() {
        page_end = parseInt($('#page_end').text());
        page_now = parseInt($('#page_now').text());
        if ((page_now - 1) <= 1) {
            // $('#page_now').text(page_end);
            $('.swiper-button-next').show();
            $('.swiper-button-prev').hide();
            $('#page_now').text((page_now - 1));
            if ((page_now - 1) == 1) {
                start = 0;
            }
            load_data_page();
            load_swiper(current, end);
        } else {
            $('.swiper-button-prev').show();
            $('.swiper-button-next').show();
            $('#page_now').text((page_now - 1));
            start = ((page_now - 2) * end);
            load_data_page();
            load_swiper(current, end);
        }
    }

    $('#select_location').change(function() {
        text = $('#autocomplete').val();
        if (text != "") {
            var res = text.split(" ", 3);
            text_title = res[0];
            text_Fname = res[1];
            text_Lname = res[2];
            if (text_Lname == undefined) text_Lname = "";
        }
        text_location = $("#select_location option:selected").val();
        text_location_sub = $("#select_location_sub option:selected").val();
        $('#loader').show();
        $('.swiper-container').hide();
        start = 0;
        load_data_page();
        current = 1;
        load_swiper(current, end);
        page_sum(current, end);
    });

    $('#select_location_sub').change(function() {
        text = $('#autocomplete').val();
        if (text != "") {
            var res = text.split(" ", 3);
            text_title = res[0];
            text_Fname = res[1];
            text_Lname = res[2];
            if (text_Lname == undefined) text_Lname = "";
        }
        text_location = $("#select_location option:selected").val();
        text_location_sub = $("#select_location_sub option:selected").val();
        start = 0;
        load_data_page();
        current = 1;
        load_swiper(current, end);
        page_sum(current, end);
    });

    var sel = $('#autocomplete');
    sel.change(function() {
        // var value = $(this).val();
        // console.log(value);
        text = $('#autocomplete').val();
        var res = text.split(" ", 3);
        text_title = res[0];
        text_Fname = res[1];
        text_Lname = res[2];
        if (text_Lname == undefined) text_Lname = "";
        text_location = $("#select_location option:selected").val();
        text_location_sub = $("#select_location_sub option:selected").val();
        start = 0;
        setTimeout(load_data_page, 1000);
        current = 1;
        load_swiper(current, end);
        page_sum(current, end);
    });

});