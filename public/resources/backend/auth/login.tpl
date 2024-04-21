{assign var="title" value="Dashboard | Sign-in"}

{include file="backend/layouts/header.tpl"}
{block name="style"}
    <link rel="stylesheet" href="{asset path='public/resources/backend/assets/vendor/css/pages/page-auth.css'}" />
{/block}
{block name="auth"}
    
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
                {include file="backend/common/logo.svg"}
            </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to Sneat! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            <form id="formAuthentication" class="form-ajax mb-3" action="{route path="admin.php?dispatch=auth.login"}" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="text" class="form-control" id="email" name="email"/>
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="auth-forgot-password-basic.html">
                    <small>Forgot Password?</small>
                </a>
                </div>
                <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="button">Sign in</button>
            </div>
            </form>
        </div>
        </div>
        <!-- /Register -->
    </div>
    </div>
</div>

{/block}
{include file="backend/layouts/footer.tpl"}