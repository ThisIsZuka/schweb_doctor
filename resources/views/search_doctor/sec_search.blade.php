@section('search')
    <div class="container" id="form_search_data">
        <div>
            <h5 class="col s12 center-align text_title">ค้นหาแพทย์</h5>
        </div>

        <div class="row row-top">
            <form class="col s12">
                <div class="input-field col s12">
                    <i class="material-icons prefix">search</i>
                    <input type="text" id="autocomplete" class="materialize-textarea autocomplete">
                    <label for="autocomplete">ค้นหาโดยชื่อแพทย์</label>
                    {{-- <a class="waves-effect waves-light btn" id="clear">ลบ</a>
                    --}}
                    <a><i class="material-icons" id="clear">clear</i></a>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col s12 center-align">
                <div class="wrapper">
                    <h5>หรือ</h5>
                </div>
            </div>
        </div>

        <div class="row row_mid">
            <div class="input-field col s12 m12">
                <select class="icons" id="select_location">
                    <option value="" disabled selected>ค้นหาจากแผนก</option>
                    <option value="" data-icon="images/sample-1.jpg">example 1</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center-align">
                <div class="wrapper">
                    <h5>หรือ</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <select id="select_location_sub">
                    <option value="" disabled selected>ค้นหาจากความเชี่ยวชาญ</option>
                    <option value="1">Option 1</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center-align row-bottom">
                {{-- <div class="wrapper" style="text-decoration: underline;">
                    <a href="#" style="color: #ffffff !important;">ค้นหาขั้นสูง</a>
                </div> --}}
            </div>
        </div>

    </div>
@endsection

@section('Show_data_search')

    <div class="container-fluid content-doctor-search">

        <div class="row">
            <div class="col s12 center-align">
                <div class="wrapper" style="text-decoration: underline; font-size: 50px;">
                    ผลการค้นหา
                </div>
            </div>
        </div>

        <div class="container row">
            <div class="col s12 right-align">
                <div class="wrapper" style="text-decoration: underline; font-size: 25px;">
                    แพทย์ที่พบ <span id="sum_doctor"></span> คน
                </div>
            </div>
        </div>

        <div class="row" id="loader">
            <div class="col s12 center-align">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper" id="show_data_card_pc">
                {{-- <div class="swiper-slide">
                    <main class="page-content">
                        <div class="row">
                            <div class="col m3">
                                <div class="card card-doctor"
                                    style="background-image: url({{ asset('Image/doctor.jpg') }});">
                                    <div class="content">
                                        <h2 class="title-card-doctor">Mountain View</h2>
                                        <p class="copy">Check out all of these gorgeous mountain trips with
                                            beautiful
                                            views
                                            of,
                                            you
                                            guessed it, the
                                            mountains</p>
                                        <button class="btn">View Trips</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col m3">
                                <div class="card card-doctor"
                                    style="background-image: url({{ asset('Image/sch-doctor.jpg') }});">
                                    <div class="content">
                                        <h2 class="title-card-doctor">To The Beach</h2>
                                        <p class="copy">Plan your next beach trip with these fabulous destinations
                                        </p>
                                        <button class="btn">View Trips</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col m3">
                                <div class="card card-doctor"
                                    style="background-image: url({{ asset('Image/test01.jpg') }});">
                                    <div class="content">
                                        <h2 class="title-card-doctor">Desert Destinations</h2>
                                        <p class="copy">It's the desert you've always dreamed of</p>
                                        <button class="btn">Book Now</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col m3">
                                <div class="card card-doctor" style="background-image: url({{ asset('Image/Big.jpg') }});">
                                    <div class="content">
                                        <h2 class="title-card-doctor">Explore The Galaxy</h2>
                                        <p class="copy">Seriously, straight up, just blast off into outer space
                                            today
                                        </p>
                                        <button class="btn">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col m3">
                                <div class="card card-doctor"
                                    style="background-image: url({{ asset('Image/doctor.jpg') }});">
                                    <div class="content">
                                        <h2 class="title-card-doctor">Mountain View</h2>
                                        <p class="copy">Check out all of these gorgeous mountain trips with
                                            beautiful
                                            views
                                            of,
                                            you
                                            guessed it, the
                                            mountains</p>
                                        <button class="btn">View Trips</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col m3">
                                <div class="card card-doctor"
                                    style="background-image: url({{ asset('Image/sch-doctor.jpg') }});">
                                    <div class="content">
                                        <h2 class="title-card-doctor">To The Beach</h2>
                                        <p class="copy">Plan your next beach trip with these fabulous destinations
                                        </p>
                                        <button class="btn">View Trips</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col m3">
                                <div class="card card-doctor"
                                    style="background-image: url({{ asset('Image/test01.jpg') }});">
                                    <div class="content">
                                        <h2 class="title-card-doctor">Desert Destinations</h2>
                                        <p class="copy">It's the desert you've always dreamed of</p>
                                        <button class="btn">Book Now</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col m3">
                                <div class="card card-doctor" style="background-image: url({{ asset('Image/Big.jpg') }});">
                                    <div class="content">
                                        <h2 class="title-card-doctor">Explore The Galaxy</h2>
                                        <p class="copy">Seriously, straight up, just blast off into outer space
                                            today
                                        </p>
                                        <button class="btn">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
                <div class="swiper-slide">Slide 2</div>
                <div class="swiper-slide">Slide 3</div>
                <div class="swiper-slide">Slide 4</div>
                <div class="swiper-slide">Slide 5</div>
                <div class="swiper-slide">Slide 6</div>
                <div class="swiper-slide">Slide 7</div>
                <div class="swiper-slide">Slide 8</div>
                <div class="swiper-slide">Slide 9</div>
                <div class="swiper-slide">Slide 10</div> --}}
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <div class="center-align" style="font-size: 35px;">
                <span id="page_now"></span>
                of
                <span id="page_end"></span>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

@endsection
