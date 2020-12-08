
{{-- navbar --}}
    <nav class="white" >
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo "  style="width: 160px;">
              <img class="responsive-img" src="{{URL::asset('public')}}/assets/logo/logosamitivejchonburi.png"  alt="">
          </a>
          <a href="#" data-target="slide-out" class="sidenav-trigger">
              <i class="fa fa-bars"  style="color:rgb(177 142 80);font-size: 30px;"></i>
            </a>
          <ul class="right hide-on-med-and-down">
            <li><a style="color:rgb(0 71 41) ;" href="sass.html">หน้าหลัก</a></li>
            <li><a style="color:rgb(0 71 41) ;" href="badges.html">ค้นหาแพทย์</a></li>
            <li><a style="color:rgb(0 71 41) ;" href="collapsible.html">ภาษา</a></li>
            {{-- <li><a style="color:rgb(0 71 41) ;" href="mobile.html">Mobile</a></li> --}}
          </ul>
        </div>
      </nav>
{{-- Side mobile --}}
      <ul id="slide-out" class="sidenav" style="opacity: 0.9; ">
        <li><a href="#!">First Sidebar Link</a></li>
        <li><a href="#!">Second Sidebar Link</a></li>
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion" style="display:none">
            <li>
              <a class="collapsible-header">Dropdown<i class="material-icons">arrow_drop_down</i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#!">First</a></li>
                  <li><a href="#!">Second</a></li>
                  <li><a href="#!">Third</a></li>
                  <li><a href="#!">Fourth</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </li>
      </ul>



