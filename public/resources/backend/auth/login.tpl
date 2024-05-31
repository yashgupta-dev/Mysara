{assign var="title" value=$lang.text_heading}

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
            <h4 class="mb-2">{$lang.text_wc_snpt}</h4>
            <p class="mb-4">{$lang.text_title}</p>

            <form id="formAuthentication" class="form-ajax mb-3" action="{route path="admin.php?dispatch=auth.login"}" method="POST">
            <div class="mb-3">
                <label for="elm-email" class="form-label">{$lang.text_username}</label>
                <input type="text" class="form-control" id="email" name="email"/>
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                <label class="form-label" for="elm_password">{$lang.text_password}</label>
                <a href="{route path="auth/forget"}">
                    <small>{$lang.text_forget}</small>
                </a>
                </div>
                <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="button">{$lang.text_signin}</button>
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