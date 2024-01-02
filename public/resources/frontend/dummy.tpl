{assign var="title" value="welcome | mysara"}

{include file="frontend/common/header.tpl"}

{block name='contact'}
    {include file="frontend/common/menu.tpl"}  
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    {include file="frontend/checkout/cart.tpl"}  
    <!-- ##### Right Side Cart End ##### -->


{/block}
{include file="frontend/common/footer.tpl"}