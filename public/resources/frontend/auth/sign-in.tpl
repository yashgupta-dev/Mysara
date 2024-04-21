<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{__('sign.text_title')}</title>

  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <!-- Favicons -->
  <link rel="icon" href="{asset path='public/assets/img/core-img/favicon.ico'}">
  <link rel="stylesheet" href="{asset path='public/assets/css/core-style.css'}">
  {* <link rel="stylesheet" href="{asset path="public/assets/auth/style.css"}" /> *}
  <link rel="stylesheet" href="{asset path='public/assets/vendor/toaster/toastr.min.css'}">

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
                    style="background-image: linear-gradient(to right, #ab3c3c26,#7f9cf552),url('{asset path="public/assets/img/pattern/pattern_5.png"}'); height:100%">
                  </div>
                </div>
                <div class="col-md-8 pl-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="{route path="welcome"}" class="noble-ui-logo d-block mb-2">
                      <img src="{asset path='public/assets/img/core-img/logo.png'}" alt="">
                    </a>

                    <h5 class="text-muted font-weight-normal mb-4">{__('sign.text_heading')}</h5>

                    <form action="{route path="auth/login"}" method="post" role="form"
                      class="form-ajax forms-sample p-3 p-md-4">
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
                        {if $config->get('config_password_forget')}
                          <div class="col-md-6">
                            <a class="d-block mt-3 text-muted" href="{route path="auth/forget"}">
                              <small>{__('sign.text_forget')}</small>
                            </a>
                          </div>
                        {/if}
                        {if $config->get('config_account_create')}
                          <div class="col-md-6">
                            <a class="d-block mt-3 text-muted" href="{route path="auth/register"}">
                              <small>{__('sign.text_create_account')}</small>
                            </a>
                          </div>
                        {/if}
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
<script src="{asset path='public/assets/js/jquery/jquery-3.6.0.min.js'}"></script>
<script src="{asset path='public/assets/vendor/toaster/toastr.min.js'}"></script>
<script src="{asset path="public/assets/js/jquery/ajax.js"}"></script>

</html>