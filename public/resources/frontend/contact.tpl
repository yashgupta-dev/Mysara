{assign var="title" value="welcome | mysara"}

{include file="frontend/common/header.tpl"}

{block name='contact'}
    {include file="frontend/common/menu.tpl"}
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    {include file="frontend/checkout/cart.tpl"}
    <!-- ##### Right Side Cart End ##### -->

    <div class="contact-area d-flex align-items-center">

        {* <div class="google-map"> *}
            <form action="{route path="contact"}" method="post" role="form" class="form-ajax p-3 p-md-4">
                <div class="row">
                    <div class="col-xl-6 form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
                    </div>
                    <div class="col-xl-6 form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message"></textarea>
                </div>
                <div class="my-3">                                                                                              
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit" class="btn btn-primary" name="button">Send Message</button></div>
            </form>
            <!--End Contact Form -->
        {* </div> *}

        <div class="contact-info">
            <h2>How to Find Us</h2>
            <p>Mauris viverra cursus ante laoreet eleifend. Donec vel fringilla ante. Aenean finibus velit id urna vehicula,
                nec maximus est sollicitudin.</p>

            <div class="contact-address mt-50">
                <p>{$config->get('config_store_address')}</p>
                <p><a class="text-dark" href="mailto:{$config->get('config_store_email')}">{$config->get('config_store_email')}</a>
                <br>
                <a class="text-dark" href="tel:{$config->get('config_store_contact')}">{$config->get('config_store_contact')}</a></p>
            </div>
        </div>

    </div>

{/block}
{include file="frontend/common/footer.tpl"}