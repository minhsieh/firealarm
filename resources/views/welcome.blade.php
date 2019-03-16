
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>即時消防-新北市 - Fire Alarm for New Taiper City</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-darkly.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" media="screen">
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
        <div class="jumbotron">
            <h1 class="display-3">即時消防-新北市</h1>
            <p class="lead">本粉絲專頁提供新北市消防消防局最新案件資訊貼文，如欲追蹤更詳細請至專頁查看，並按個讚給予支持。</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="https://www.facebook.com/%E5%8D%B3%E6%99%82%E6%B6%88%E9%98%B2-%E6%96%B0%E5%8C%97%E5%B8%82-113165399264137/" target="__blank" role="button">Facebook Page</a>
            </p>
        </div>
      <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr class="table-dark">
                        <th>時間</th>
                        <th>類型</th>
                        <th>分隊</th>
                        <th>狀態</th>
                        <th>地點</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alarms as $alarm)
                        @if(mb_substr($alarm->type,0,2,"utf-8") == '救護')
                        <tr class="table-info">
                        @elseif(mb_substr($alarm->type,0,2,"utf-8") == '火警')
                        <tr class="table-danger">
                        @else
                        <tr class="table-warning">
                        @endif
                        <td>{{ $alarm->time }}</td>
                        <td>{{ $alarm->type }}</td>
                        <td>{{ $alarm->team }}</td>
                        <td>{{ $alarm->status }}</td>
                        <td>{{ $alarm->location }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
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
  </body>
</html>
