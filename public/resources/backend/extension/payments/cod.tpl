{assign var="title" value=$lang.text_heading}

{include file="backend/layouts/header.tpl"}

{block name="backend_page"}
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {* {$menu} *}
            {block name="menu"}
                {include file="backend/common/menu.tpl"}
            {/block}
            <!-- Layout container -->
            <div class="layout-page">
                {block name="nav"}
                    {include file="backend/layouts/nav.tpl"}
                {/block}

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch}
                        
                        <!-- Responsive Table -->
                        <div class="card">
                            <div class="card-body">

                            <form class="form-ajax mb-3" action="{route path='admin.php?dispatch=extension.payments.cod.save'}" method="POST"
                                enctype="multipart/form-data">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="input-status">{$lang.text_status}</label>
                                    <select class="form-control" id="status" name="payments_cod_status">
                                        <option value="D" {if !empty($setting) && $setting.payments_cod_status == 'D'} selected {/if}>{$lang.text_disabled}</option>
                                        <option value="A" {if !empty($setting) && $setting.payments_cod_status == 'A'} selected {/if}>{$lang.text_enabled}</option>
                                    </select>                                    

                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="input-total">{$lang.text_total}</label>
                                    <input class="form-control" id="total" value="{if !empty($setting)}{$setting.payments_cod_total}{/if}" type="text" name="payments_cod_total">
                                </div>
                                <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" name="button">{'Save changes'}</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        <!--/ Responsive Table -->
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    {block name="footer_note"}
                        {include file="backend/layouts/footer_note.tpl"}
                    {/block}
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
{/block}

{include file="backend/layouts/footer.tpl"}