{assign var="categories" value=$func->fn_get_Categories()}
<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="{route path="welcome"}"><img src="{asset path='public/assets/img/core-img/logo.png'}"
                    alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        {foreach from=$categories item=category key=index}
                            {if $category.children}
                                <li><a href="#">{$category.name}</a>
                                {* {split data=$category.children size=2|default:"5" assign="child_category"} *}
                                {* {$child_category|print_r} *}
                                <div class="megamenu">
                                    <ul class="single-mega cn-col-4">                                            
                                    {foreach from=$category.children item=child key=key}
                                        <li><a href="{route path="product/category?search=dresses"}">{$child.name}</a></li>
                                    {/foreach}
                                    </ul>
                                </div>
                                </li>
                            {else}
                                <li><a href="{route path="blog/blog"}">{$category.name}</a></li>
                            {/if}
                        {/foreach}
                        
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <!-- Favourite Area -->
            <div class="favourite-area">
                <a href="#"><img src="{asset path='public/assets/img/core-img/heart.svg'}" alt=""></a>
            </div>
            <!-- User Login Info -->
            <div class="user-login-info">
                <a href="{route path="auth/login"}"><img src="{asset path='public/assets/img/core-img/user.svg'}" alt=""></a>
            </div>
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn"><img src="{asset path='public/assets/img/core-img/bag.svg'}" alt="">
                    <span>3</span></a>
            </div>
        </div>

    </div>
</header>