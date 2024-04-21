{assign var="title" value="Dashboard | Forget"}

{include file="backend/layouts/header.tpl"}
{block name="style"}
    <link rel="stylesheet" href="{asset path='public/resources/backend/assets/vendor/css/pages/page-auth.css'}" />
{/block}
{block name="auth_forget"}
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
                {include file="backend/common/logo.svg"}                
            </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Forgot Password? 🔒</h4>
            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
            <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                placeholder="Enter your email"
                autofocus />
            </div>
            <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
            </form>
            <div class="text-center">
            <a href="auth-login-basic.html" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
            </a>
            </div>
        </div>
        </div>
        <!-- /Forgot Password -->
    </div>
    </div>
</div>
{/block}

{include file="backend/layouts/footer.tpl"}