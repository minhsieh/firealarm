<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>即時消防-新北市 - Fire Alarm for New Taiper City</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-darkly.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" media="screen">
    @section('page-css')
    @show
  </head>
  <body>
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
      <div class="container">
        <a href="../" class="navbar-brand">即時消防 新北市</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
    <div class="container">
        @section('page-content')
        @show
        
      <footer id="footer">
        <div class="row">
          <div class="col-lg-12">

            <ul class="list-unstyled">
              <li class="float-lg-right"><a href="#top">Back to top</a></li>
              <li><a href="https://github.com/minhsieh/firealarm/">GitHub</a></li>
              <li><a href="javascript:;">API</a></li>
              <li><a href="javascript:;">Donate</a></li>
            </ul>
            <p>Made by <a href="https://imin.tw">Min</a>.</p>
            <p>Based on <a href="https://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fontawesome.io/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="https://fonts.google.com/" rel="nofollow">Google</a>.</p>
          </div>
        </div>
      </footer>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    @section('page-js')
    @show()
  </body>
</html>
