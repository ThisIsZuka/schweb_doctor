@section('search')
    <div class="container">
        <div>
            <h5 class="col s12 center-align text_title">ค้นหาแพทย์</h5>
        </div>

        <div class="row row-top">
            <form class="col s12">
                <div class="input-field col s12">
                    <i class="material-icons prefix">search</i>
                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                    <label for="icon_prefix2">ค้นหาโดยชื่อแพทย์</label>
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
            <div class="input-field col s12 m12" id="select_department">
                <select class="icons">
                    <option value="" disabled selected>ค้นหาจากแผนก</option>
                    <option value="" data-icon="images/sample-1.jpg">example 1</option>
                    <option value="" data-icon="images/office.jpg">example 2</option>
                    <option value="" data-icon="images/yuna.jpg">example 3</option>
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
                <select>
                    <option value="" disabled selected>ค้นหาจากความเชี่ยวชาญ</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center-align row-bottom">
                <div class="wrapper" style="text-decoration: underline;">
                    <a href="#" style="color: #ffffff !important;">ค้นหาขั้นสูง</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('Show_data_search')
    <div class="container content-doctor-search">

        <div class="row">
            <div class="col s12 center-align">
                <div class="wrapper" style="text-decoration: underline; font-size: 50px;">
                    ผลการค้นหา
                </div>
            </div>
        </div>

        <div class="carousel">
            <a class="carousel-item" href="#one!"><img src="{{ asset('Image/closeup-support-hands.jpg') }}"></a>
            <a class="carousel-item" href="#two!"><img src="{{ asset('Image/closeup-support-hands.jpg') }}"></a>
            <a class="carousel-item" href="#three!"><img src="{{ asset('Image/closeup-support-hands.jpg') }}"></a>
            <a class="carousel-item" href="#four!"><img src="{{ asset('Image/closeup-support-hands.jpg') }}"></a>
            <a class="carousel-item" href="#five!"><img src="{{ asset('Image/closeup-support-hands.jpg') }}"></a>
        </div>
    </div>
@endsection
