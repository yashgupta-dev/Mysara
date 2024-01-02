{assign var="title" value="welcome | mysara"}

{include file="frontend/common/header.tpl"}

{block name='blog_view'}
    {include file="frontend/common/menu.tpl"}  
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    {include file="frontend/checkout/cart.tpl"}  
    <!-- ##### Right Side Cart End ##### -->

        <!-- ##### Blog Wrapper Area Start ##### -->
        <div class="single-blog-wrapper">

        <!-- Single Blog Post Thumb -->
        <div class="single-blog-post-thumb">
            <img src="{asset path='public/assets/img/bg-img/bg-7.jpg'}" alt="">
        </div>

        <!-- Single Blog Content Wrap -->
        <div class="single-blog-content-wrapper d-flex">

            <!-- Blog Content -->
            <div class="single-blog--text">
                <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis perferendis rem accusantium ducimus animi nesciunt expedita omnis aut quas molestias!</h2>
                <p>Mauris viverra cursus ante laoreet eleifend. Donec vel fringilla ante. Aenean finibus velit id urna vehicula, nec maximus est sollicitudin. Praesent at tempus lectus, eleifend blandit felis. Fusce augue arcu, consequat a nisl aliquet, consectetur elementum turpis. Donec iaculis lobortis nisl, et viverra risus imperdiet eu. Etiam mollis posuere elit non sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis arcu a magna sodales venenatis. Integer non diam sit amet magna luctus mollis ac eu nisi. In accumsan tellus ut dapibus blandit.</p>

                <blockquote>
                    <h6><i class="fa fa-quote-left" aria-hidden="true"></i> Quisque sagittis non ex eget vestibulum. Sed nec ultrices dui. Cras et sagittis erat. Maecenas pulvinar, turpis in dictum tincidunt, dolor nibh lacinia lacus.</h6>
                    <span>Liam Neeson</span>
                </blockquote>

                <p>Praesent ac magna sed massa euismod congue vitae vitae risus. Nulla lorem augue, mollis non est et, eleifend elementum ante. Nunc id pharetra magna. Praesent vel orci ornare, blandit mi sed, aliquet nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
            </div>

            <!-- Related Blog Post -->
            <div class="related-blog-post">
                <!-- Single Related Blog Post -->
                <div class="single-related-blog-post">
                    <img src="{asset path='public/assets/img/bg-img/rp1.jpg'}" alt="">
                    <a href="#">
                        <h5>Cras lobortis nisl nec libero pulvinar lacinia. Nunc sed ullamcorper massa</h5>
                    </a>
                </div>
                <!-- Single Related Blog Post -->
                <div class="single-related-blog-post">
                    <img src="{asset path='public/assets/img/bg-img/rp2.jpg'}" alt="">
                    <a href="#">
                        <h5>Fusce tincidunt nulla magna, ac euismod quam viverra id. Fusce eget metus feugiat</h5>
                    </a>
                </div>
                <!-- Single Related Blog Post -->
                <div class="single-related-blog-post">
                    <img src="{asset path='public/assets/img/bg-img/rp3.jpg'}" alt="">
                    <a href="#">
                        <h5>Etiam leo nibh, consectetur nec orci et, tempus tempus ex</h5>
                    </a>
                </div>
                <!-- Single Related Blog Post -->
                <div class="single-related-blog-post">
                    <img src="{asset path='public/assets/img/bg-img/rp4.jpg'}" alt="">
                    <a href="#">
                        <h5>Sed viverra pellentesque dictum. Aenean ligula justo, viverra in lacus porttitor</h5>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <!-- ##### Blog Wrapper Area End ##### -->


{/block}
{include file="frontend/common/footer.tpl"}