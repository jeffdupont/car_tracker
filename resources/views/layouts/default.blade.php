<!doctype html>
<html lang="en">
<head>
  <!-- start: Meta -->
  <meta charset="utf-8">
  <title>Car Tracker | Inventory &amp; Maintenance Scheduling</title>
  <meta name="description" content="Car Tracker">
  <meta name="keyword" content="Car Tracker Inventory Maintenance Scheduling">
  <!-- end: Meta -->

  <!-- start: Mobile Specific -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- end: Mobile Specific -->

  <!-- start: Web Fonts -->
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,500|Source+Code+Pro:400,500,700" rel="stylesheet">
  <!-- end: Web Fonts -->

  @if(App::environment() == "production")
  <link rel="stylesheet" href="/dist/css/compiled.min.css" media="screen" charset="utf-8">
  @else
  <link rel="stylesheet" href="/dist/css/compiled.css" media="screen" charset="utf-8">
  @endif
  @yield("style")

  <script src="/dist/js/vendor/modernizr.js"></script>

  <script charset="utf-8">
  document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"><\/script>');
  </script>

</head>
<body class="antialiased">

  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
      <li class="name">
        <h1><a href="{{ URL::to('dashboard') }}">Car Tracker Portal</a></h1>
      </li>
      <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
      <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
    </ul>

    @if (Auth::user())
    <section class="top-bar-section">
      <!-- Right Nav Section -->
      <ul class="right">
        @if( Auth::user()->is_admin )
        <li class="has-dropdown">
          <a href="{{ URL::to('dashboard') }}"><i class="fa fa-cog"></i> Administration</a>
          <ul class="dropdown">
            <li><a href="{{ URL::to('users') }}"><i class="fa fa-users"></i> Users</a></li>
          </ul>
        </li>
        @endif
        <li class="has-dropdown">
          <a href="#">{{ Auth::user()->display_name }} <i class="fa fa-ellipsis-v"></i></a>
          <ul class="dropdown">
            <li><a href="{{ URL::to('profile') }}"><i class="fa fa-wrench"></i> Edit Profile</a></li>
            <li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </li>
      </ul>

      <!-- Left Nav Section -->
      <ul class="left">
        <li><a href="{{ URL::to('clients') }}"><i class="fa fa-user"></i> Clients</a></li>
        <li><a href="{{ URL::to('cars') }}"><i class="fa fa-car"></i> Cars</a></li>
      </ul>
    </section>
    @endif
  </nav>

  @if (Auth::user())
  <ul class="breadcrumbs">
    <li><a href="{{ URL::to('dashboard') }}">Home</a></li>
    @yield("breadcrumb")
  </ul>

  @yield("subheader")
  @endif

  <section role="main" class="scroll-container">
    @yield("content")

    @if( $errors->first('validation') )
    <div data-alert class="alert-box alert">
      {{ $errors->first('validation') }}
      <a href="#" class="close">&times;</a>
    </div>
    @endif
    @if( Session::has('success') )
    <div data-alert class="alert-box success">
      {{ Session::get('success') }}
      <a href="#" class="close">&times;</a>
    </div>
    @endif
  </section>

  <footer class="clearfix">
    @yield("footer")
    <div class="row">
      <div class="small-12 column">
        <span class="pull-right"></span>
      </div>
    </div>
  </footer>


  <script src="/dist/js/vendor/fastclick.js"></script>

  @if(App::environment() == "production")
  <script src="/dist/lite-uploader/jquery.liteuploader.min.js"></script>
  <script src="/dist/js/foundation.min.js"></script>
  <script src="/dist/js/compiled.min.js"></script>
  @else
  <script src="/dist/lite-uploader/jquery.liteuploader.js"></script>
  <script src="/dist/js/foundation.js"></script>
  <script src="/dist/js/compiled.js"></script>
  @endif

  <script>
    $(document).foundation();
    $(document).ready(function() {
      $(".alert-box").delay(4000).fadeOut(500);
    });
  </script>
  @yield("script")

  <!-- Change UA-XXXXX-X to be your site's ID -->
  <!--<script>
  window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
    load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
  });
  </script>-->

</body>
</html>
