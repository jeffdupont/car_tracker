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
  <link rel="stylesheet" href="/dist/css/compiled.min.css" media="print" charset="utf-8">
  @else
  <link rel="stylesheet" href="/dist/css/compiled.css" media="screen" charset="utf-8">
  <link rel="stylesheet" href="/dist/css/compiled.css" media="print" charset="utf-8">
  @endif
  @yield("style")

</head>
<body class="antialiased">

  <section role="main" class="scroll-container">
    @yield("content")
  </section>

  <!-- Change UA-XXXXX-X to be your site's ID -->
  <!--<script>
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
    load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
  });
  </script>-->

</body>
</html>
