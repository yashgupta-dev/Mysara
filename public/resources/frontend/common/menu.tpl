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
                        <li><a href="#">Shop</a>
                            <div class="megamenu">
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Women's Collection</li>
                                    <li><a href="{route path="product/category?search=dresses"}">Dresses</a></li>
                                    <li><a href="{route path="product/category?search=Blouses"}">Blouses &amp; Shirts</a></li>
                                    <li><a href="{route path="product/category?search=T-shirt"}">T-shirts</a></li>
                                    <li><a href="{route path="product/category?search=Rompers"}">Rompers</a></li>
                                    <li><a href="{route path="product/category?search=Bras"}">Bras &amp; Panties</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Men's Collection</li>
                                    <li><a href="{route path="product/category"}">T-Shirts</a></li>
                                    <li><a href="{route path="product/category?search=Polo"}">Polo</a></li>
                                    <li><a href="{route path="product/category?search=Shirts"}">Shirts</a></li>
                                    <li><a href="{route path="product/category?search=Jackets"}">Jackets</a></li>
                                    <li><a href="{route path="product/category?search=Trench"}">Trench</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Kid's Collection</li>
                                    <li><a href="{route path="product/category?search=Dresses"}">Dresses</a></li>
                                    <li><a href="{route path="product/category?search=Shirts"}">Shirts</a></li>
                                    <li><a href="{route path="product/category"}">T-shirts</a></li>
                                    <li><a href="{route path="product/category?search=Jackets"}">Jackets</a></li>
                                    <li><a href="{route path="product/category?search=Trench"}">Trench</a></li>
                                </ul>
                                <div class="single-mega cn-col-4">
                                    <img src="{asset path='public/assets/img/bg-img/bg-6.jpg'}" alt="">
                                </div>
                            </div>
                        </li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="{route path="welcome"}">Home</a></li>
                                <li><a href="{route path="product/category"}">Shop</a></li>
                                <li><a href="{route path="product/product?product_id=2323"}">Product Details</a></li>
                                <li><a href="{route path="checkout/checkout"}">Checkout</a></li>
                                <li><a href="{route path="blog/blog"}">Blog</a></li>
                                <li><a href="{route path="blog/blog/view?blog_id=10"}">Single Blog</a></li>
                                <li><a href="#">Regular Page</a></li>
                                <li><a href="{route path="welcome/contact"}">Contact</a></li>
                            </ul>
                        </li>
                        <li><a href="{route path="blog/blog"}">Blog</a></li>
                        <li><a href="{route path="welcome/contact"}">Contact</a></li>
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