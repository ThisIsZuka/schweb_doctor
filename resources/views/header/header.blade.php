<section>
    <nav class="">
        <div class="nav-wrapper lighten-2">
          <a href="#!" class="brand-logo "  style="width: 160px;">
              <img class="responsive-img" src="{{URL::asset('')}}assets/logo/SamitivejCorporateLogo.jpg"  alt="">
          </a>
          <a href="#" data-target="mobile" class="sidenav-trigger">
              <i class="material-icons"></i>
            </a>
          <ul class="right hide-on-med-and-down">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">Javascript</a></li>
            <li><a href="mobile.html">Mobile</a></li>
          </ul>
        </div>
      </nav>

      <ul class="sidenav" id="mobile">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li>
      </ul>
</section>
<script>
    $(document).ready(function(){
    $('.sidenav').sidenav();
    });
</script>

