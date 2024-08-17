{assign var="title" value="category | mysara"}

{include file="frontend/common/header.tpl"}

{block name='product'}
    {include file="frontend/common/menu.tpl"}  
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    {include file="frontend/checkout/cart.tpl"}  
    <!-- ##### Right Side Cart End ##### -->
        <!-- ##### Single Product Details Area Start ##### -->
        <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <img src="{asset path='public/assets/img/product-img/product-big-1.jpg'}" alt="">
                <img src="{asset path='public/assets/img/product-img/product-big-2.jpg'}" alt="">
                <img src="{asset path='public/assets/img/product-img/product-big-3.jpg'}" alt="">
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>mango</span>
            <a href="{route path="checkout/cart"}">
                <h2>One Shoulder Glitter Midi Dress</h2>
            </a>
            <p class="product-price"><span class="old-price">$65.00</span> $49.00</p>
            <p class="product-desc">Mauris viverra cursus ante laoreet eleifend. Donec vel fringilla ante. Aenean finibus velit id urna vehicula, nec maximus est sollicitudin.</p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">Size: XL</option>
                        <option value="value">Size: X</option>
                        <option value="value">Size: M</option>
                        <option value="value">Size: S</option>
                    </select>
                    <select name="select" id="productColor">
                        <option value="value">Color: Black</option>
                        <option value="value">Color: White</option>
                        <option value="value">Color: Red</option>
                        <option value="value">Color: Purple</option>
                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->


{/block}

{include file="frontend/common/footer.tpl"}