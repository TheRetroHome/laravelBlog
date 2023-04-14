
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Login Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2-bootstrap4.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a>Login</a>
  </div>
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Авторизация пользователя</p>
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
        @endif
      <form action="{{route('login')}}" method="post">
      @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Пароль">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<script src="{{ asset('assets/admin/js/admin.js') }}"></script>
<script src="{{ asset('assets/admin/js/select2.full.min.js') }}"></script>
            <script>
                $('.nav-sidebar a').each(function () {
                    let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
                    let link = this.href;
                    if (link == location) {
                        $(this).addClass('active');
                        $(this).closest('.has-treeview').addClass('menu-open');
                    }
                });
                $('.select2').select2()
            </script>
</body>
</html>

