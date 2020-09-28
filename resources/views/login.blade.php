<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .form-group{
            margin-top: 16px;
            margin-bottom: 0;
        }
        .form-check{
            margin-top:16px;
            margin-bottom: 0;
        }
        .form_style{
            max-width:350px!important;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container-fluid bg-primary vh-100 d-flex flex-column justify-content-center">
          <div class="container form_style bg-white h-50 rounded shadow vw-100 " >
              <h1 class="display-5 text-center pt-3">Login</h1>
              <form action="{{route('login')}}" method="POST" class="d-flex align-content-between flex-column ">
                @csrf
                  <div class="form-group">
                    <input type="email" class="form-control rounded" name="email" id="email"  placeholder="Email address">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control rounded" name="pass" id="pass"  placeholder="Password">
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" >
                      Remember me
                    </label>
                    <label class="form-check-label float-right text-body">
                        <a href="#">Forgot password?</a>
                      </label>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-success w-100 rounded ">Login</button>
                  </div>
              </form>
          </>
          <div class="container text-center text-white mb-5 pt-1">
              <p class="">Don't have a account? <a href="/register" class="text-white">Register here!</a></p>
          </div>
          <!-- @if ($errors->any())
            <div class="alert alert-danger mt-0">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
            </div>
            @endif -->
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
