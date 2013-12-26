<!DOCTYPE html>
<html>
  <head>
    <title>Finance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link href="/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/">Finance</a>
        </div>
        <div class="collapse navbar-collapse">
          @if(Auth::check())
            <ul class="nav navbar-nav">
              <li{{ Request::is('stocks/peaks') ? ' class="active"' : '' }}>{{HTML::link('/stocks/peaks','Peaks')}}</li>
              <li{{ Request::is('queries') ? ' class="active"' : '' }}>{{HTML::link('/queries','Queries')}}</li>
            </ul>
          @endif
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
               <li>{{ HTML::link('users/logout', 'Logout') }}</li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">
      @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
      @endif
      @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    @yield('js', '')
  </body>
</html>
