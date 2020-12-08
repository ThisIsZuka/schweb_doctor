$(document).ready(function() {

    var datatable;
    var sum;
    var current_doc;
    var total_doc;
    var start;
    var end;

    // ค่าการค้นหา
    // var text_title = "";
    var text_Fname = "";
    var text_Lname = "";
    var text_location = "";
    var text_location_sub = "";

    var data_location;

    let options = {};

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //card slider
    let mySwiper;
    // var mySwiper = new Swiper('.swiper-container', {
    //     init: false,
    //     effect: 'coverflow',
    //     // watchOverflow: true,
    //     // allowTouchMove: true,
    // });

    // loading screen
    var spinner = new jQuerySpinner({
        parentId: 'div_card',
    });

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
    if (width <= 900) {
        start = 0;
        end = 1;
        load_data_FirstCome();
    } else if (width < 1400 && width > 900) {
        start = 0;
        end = 4;
        load_data_FirstCome();
    } else if (width >= 1400) {
        start = 0;
        end = 6;
        load_data_FirstCome();
    }


    // $(window).resize(function() {
    //     var width = $(window).width();
    //     if (width <= 900) {
    //         start = 0;
    //         end = 1;
    //         load_data_FirstCome();
    //     } else if (width < 1400 && width > 900) {
    //         start = 0;
    //         end = 4;
    //         load_data_FirstCome();
    //     } else if (width >= 1400) {
    //         start = 0;
    //         end = 6;
    //         load_data_FirstCome();
    //     }
    // });



    // โหลดข้อมูลแพทย์เมื่อเปิด
    // load_data_FirstCome();

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
            beforeSend: function() {
                spinner.show();
            },
            complete: function() {
                spinner.hide();
            },
            success: function(response) {
                datatable = response;
                var html = '';
                var i;
                var count;
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        count = i;
                        var description = "";

                        if (response[i].description != null || response[i].description != "") {
                            description = response[i].description;
                        }

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

                        var titlename = response[i].titlename
                        if (response[i].titlename == null || response[i].titlename == "") {
                            titlename = "";
                        }

                        html += '<div class="col">';
                        if (response[i].doctor_img != "") {
                            html += '<div class="card card-doctor" style="background-image: url(\'Image/doctor/resize_imgs/' + response[i].doctor_img + '\');">';
                        } else {
                            html += '<div class="card card-doctor" style="background-image: url(\'Image/not-found-doctor/non-found.png\');">';
                        }

                        html += '<div class="content">' +
                            '<h2 class="title-card-doctor">' + titlename + response[i].forename + " " + response[i].surname + '</h2>' +
                            '<p class="copy">' + description + ' </p>' +
                            '<button class="btn-large" id="btn' + response[i].medical_id + '">นัดหมายแพทย์</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    }
                }
                // console.log(html)
                $('#show_data_card_pc').html(html);
                $.each(response, function(i, v) {
                    $('#btn' + response[i].medical_id).click(function() {
                        // alert(response[i].medical_id);
                        // window.location.href = '../Std_download/download/' + response[i].fileName;
                        window.location = "http://newdoctor.samitivejchonburi.com/public/" + response[i].medical_id;
                    });
                });
                // M.AutoInit();
                current = 1;
                load_swiper(current, end);
                page_sum(current, end);
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
                text_Fname: text_Fname,
                text_Lname: text_Lname,
                text_location: text_location,
                text_location_sub: text_location_sub,
                _token: _token
            },
            dataType: "json",
            beforeSend: function() {
                spinner.show();
            },
            complete: function() {
                // spinner.hide();
            },
            success: function(response) {
                datatable = response;
                var html = '';
                var i;
                var count;
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        count = i;
                        var description = response[i].description;

                        if (response[i].description == null || response[i].description == "") {
                            description = "";
                        }

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

                        var titlename = response[i].titlename
                        if (response[i].titlename == null || response[i].titlename == "") {
                            titlename = "";
                        }

                        html += '<div class="col">';
                        if (response[i].doctor_img != "") {
                            html += '<div class="card card-doctor" style="background-image: url(\'Image/doctor/resize_imgs/' + response[i].doctor_img + '\');">';
                        } else {
                            html += '<div class="card card-doctor" style="background-image: url(\'Image/not-found-doctor/non-found.png\');">';
                        }

                        html += '<div class="content">' +
                            '<h2 class="title-card-doctor">' + titlename + response[i].forename + " " + response[i].surname + '</h2>' +
                            '<p class="copy">' + description + ' </p>' +
                            '<button class="btn-large" id="btn' + response[i].medical_id + '">นัดหมายแพทย์</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    }
                }
                // console.log(html)
                $('#show_data_card_pc').html(html);
                $.each(response, function(i, v) {
                    $('#btn' + response[i].medical_id).click(function() {
                        window.location = "http://newdoctor.samitivejchonburi.com/public/" + response[i].medical_id;
                    });
                });
                current = start;
                if (current == 0) {
                    current = 1;
                }
                load_swiper(current, end);
                spinner.hide();
                // page_sum(current, end);
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
                data_location = response;
                var html = "";
                html += '<option value="NoData" disabled selected>ค้นหาจากแผนก</option>';
                html += '<option value="" >ค้นหาจากแผนกทั้งหมด</option>';
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        html += '<option id="option' + response[i].code + '"  value="' + response[i].code + '" data-icon="Image/Icon/' + response[i].medical_center_icon + '"> ' + response[i].description_th + '</option>';
                    }
                    $('#select_location').html(html);
                    // $('#select_location').select2();
                    $("#select_location").select2({
                        templateResult: formatState_location,
                        templateSelection: formatState_location
                    });
                }
                // $('#select_location').formSelect();
            }
        });
    }

    function formatState_location(opt) {
        if (!opt.id) {
            return opt.text;
        }
        var optimage = $(opt.element).attr('data-icon');
        // console.log(optimage)
        if (!optimage) {
            return opt.text.toUpperCase();
        } else {
            var $opt = $(
                // '<span><img style="width: 10%;" src="' + optimage + '" /> ' + opt.text + '</span>'
                '<div class="heading2" >' +
                '<img style="width: 8%;" src="' + optimage + '" />' +
                '&nbsp;' +
                '<span>' + opt.text + '</span>' +
                '</div>'
            );
            return $opt;
        }
    };


    // โหลดข้อมูลความเชี่ยวชาญ
    load_location_sub();

    function load_location_sub() {
        $.ajax({
            url: 'Get_location_sub_ctls',
            dataType: "json",
            success: function(response) {
                var html = "";
                html += '<option value="NoData" disabled selected>ค้นหาจากสาขาความเชี่ยวชาญ</option>';
                html += '<option value="" >ค้นหาจากสาขาความเชี่ยวชาญทั้งหมด</option>';
                if (response != null) {
                    for (i = 0; i < response.length; i++) {
                        html += '<option id="option_sub' + response[i].uid + '" value="' + response[i].uid + '">' + response[i].description + '</option>';
                    }
                }
                $('#select_location_sub').html(html);
                // $('#select_location_sub').formSelect();
                $("#select_location_sub").select2();
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
                    onAutocomplete: function() {
                        autoSelect_nameDoctor();
                    },
                    // limit: 10,
                });
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
                text_Fname: text_Fname,
                text_Lname: text_Lname,
                text_location: text_location,
                text_location_sub: text_location_sub,
                _token: _token
            },
            dataType: "json",
            success: function(response) {
                mySwiper = new Swiper('.swiper-container', {
                    init: false,
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'custom',
                        renderCustom: function(mySwiper, current, total) {

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
                    // allowTouchMove: false,
                    // simulateTouch: false,
                    // renderCustom: function(swiper, current, total) {
                    //     return current + ' of ' + total;
                    // }
                });
                mySwiper.init();
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
                if (page_end == 0) {
                    $('#page_end').text(page_end);
                    $('#page_now').text(page_end);
                    $('.swiper-button-next').hide();
                    $('.swiper-button-prev').hide();
                } else {
                    page_end = Math.ceil(page_end);
                    $('#page_end').text(page_end);
                    $('#page_now').text(current);
                    $('.swiper-button-prev').hide();
                    if (current == page_end) {
                        $('.swiper-button-next').hide();
                    } else {
                        $('.swiper-button-next').show();
                    }
                }
            }
        });
    }


    document.addEventListener('touchstart', handleTouchStart, false);
    document.addEventListener('touchmove', handleTouchMove, false);

    var xDown = null;
    var yDown = null;

    function getTouches(evt) {
        return evt.touches || // browser API
            evt.originalEvent.touches; // jQuery
    }

    function handleTouchStart(evt) {
        const firstTouch = getTouches(evt)[0];
        xDown = firstTouch.clientX;
        yDown = firstTouch.clientY;
    };

    function handleTouchMove(evt) {
        if (!xDown || !yDown) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if (Math.abs(xDiff) > Math.abs(yDiff)) {
            /*most significant*/
            if (xDiff > 0) {
                /* left swipe */
                slide_next();
            } else {
                /* right swipe */
                silde_prev();
            }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    };

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
        text_Fname = "";
        text_Lname = "";
        start = 0;
        load_data_page();
        current = 1;
        load_swiper(current, end);
        page_sum(current, end);
    })


    function slide_next() {
        page_end = parseInt($('#page_end').text());
        page_now = parseInt($('#page_now').text());
        console.log('next')
        if (page_end == page_now) {
            $('.swiper-button-next').hide();
        } else if ((page_now + 1) >= page_end) {
            $('.swiper-button-next').hide();
            $('.swiper-button-prev').show();
            $('#page_now').text(page_end);
            start = (page_now * end);
            if (page_now != page_end) {
                load_data_page();
                load_swiper(current, end);
            }
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
        console.log('prev')
        if ((page_now - 1) <= 1) {
            // $('#page_now').text(page_end);
            $('.swiper-button-next').show();
            $('.swiper-button-prev').hide();
            $('#page_now').text('1');
            if ((page_now - 1) == 1) {
                start = 0;
                load_data_page();
                load_swiper(current, end);
            }
            if (page_now != page_end) {
                load_data_page();
                load_swiper(current, end);
            }
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
        // text = $('#autocomplete').val();
        // if (text != "") {
        //     var res = text.split(" ", 3);
        //     check_txt = res[2];
        //     if (check_txt == undefined) {
        //         text_Fname = res[0];
        //         text_Lname = res[1];
        //     } else {
        //         text_Fname = res[1];
        //         text_Lname = res[2];
        //     }
        // }
        $('#autocomplete').val("");
        text_Fname = "";
        text_Lname = "";
        text_location = $("#select_location option:selected").val();
        text_location_sub = "";
        // $('#select_location_sub').select2('destroy');
        // $('#select_location_sub').val('NoData').select2();
        $("#select_location_sub").val('NoData').trigger('change.select2');
        start = 0;
        load_data_page();
        current = 1;
        load_swiper(current, end);
        page_sum(current, end);

        $([document.documentElement, document.body]).animate({
            scrollTop: $(".content-doctor-search").offset().top
        }, 1500);
    });


    $('#select_location_sub').change(function() {
        text_location_sub = $("#select_location_sub option:selected").val();
        // text = $('#autocomplete').val();
        // if (text != "") {
        //     var res = text.split(" ", 3);
        //     check_txt = res[2];
        //     if (check_txt == undefined) {
        //         text_Fname = res[0];
        //         text_Lname = res[1];
        //     } else {
        //         text_Fname = res[1];
        //         text_Lname = res[2];
        //     }
        // }
        $('#autocomplete').val("");
        // $('#select_location').select2('destroy');
        // $('#select_location').val('NoData').select2();
        $("#select_location").val('NoData').trigger('change.select2');
        text_Fname = "";
        text_Lname = "";
        text_location = "";
        start = 0;
        load_data_page();
        current = 1;
        load_swiper(current, end);
        page_sum(current, end);

        $([document.documentElement, document.body]).animate({
            scrollTop: $(".content-doctor-search").offset().top
        }, 1500);
    });

    function autoSelect_nameDoctor() {
        var value = $('#autocomplete').val();
        // console.log(value);
        text = $('#autocomplete').val();
        var res = text.split(" ", 3);
        check_txt = res[2];
        if (check_txt == undefined) {
            text_Fname = res[0];
            text_Lname = res[1];
        } else {
            text_Fname = res[1];
            text_Lname = res[2];
        }
        if (text_Lname == undefined) text_Lname = "";
        text_location = "";
        // $('#select_location').select2('destroy');
        // $('#select_location').val('NoData').select2();
        $("#select_location").val('NoData').trigger('change.select2');
        text_location_sub = "";
        // $('#select_location_sub').select2('destroy');
        // $('#select_location_sub').val('NoData').select2();
        $("#select_location_sub").val('NoData').trigger('change.select2');
        start = 0;
        // setTimeout(, 1000);
        load_data_page();
        current = 1;
        load_swiper(current, end);
        page_sum(current, end);

        $([document.documentElement, document.body]).animate({
            scrollTop: $(".content-doctor-search").offset().top
        }, 1500);
    }

});