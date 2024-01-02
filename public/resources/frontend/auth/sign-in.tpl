<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign-in</title>

  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <!-- Favicons -->
  <link rel="icon" href="{asset path='public/assets/img/core-img/favicon.ico'}">
  
  <link rel="stylesheet" href="{asset path="public/assets/auth/style.css"}" />
  <link href="{asset path="public/assets/css/toaster/toastr.min.css"}" rel="stylesheet">

</head>

<body>

  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
          <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="row">
                <div class="col-md-4 pr-md-0">
                  <div class="auth-left-wrapper"
                    style="background-image: linear-gradient(to right, #ab3c3c26,#7f9cf552),url('{asset path="public/assets/img/pattern_5.png"}');">
                  </div>
                </div>
                <div class="col-md-8 pl-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="{route path="welcome"}" class="noble-ui-logo d-block mb-2">
                    <h1>Yummy<span>.</span></h1>
                    </a>

                    <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>

                    <form action="{route path="auth/login/index"}" method="post" role="form" class="forms-sample form-ajax p-3 p-md-4">
                      <div class="form-group">
                        <label for="elm_email">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" name="email" />
                      </div>

                      <div class="form-group">
                        <label for="elm_password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" />

                      </div>
                      
                      <div class="mt-3">
                        <button type="submit" name="button" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Sign
                          in</button>
                      </div>
                      <div class="form-row">

                        <div class="col-md-6">
                          <a class="d-block mt-3 text-muted" href="/">
                            <small>Forgot Your Password?</small>
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="{asset path='public/assets/js/jquery-3.6.0.min.js'}"></script>
<script src="{asset path="public/assets/css/toaster/toastr.min.js"}"></script>
<script src="{asset path="public/assets/js/ajax.js"}"></script>

</html>