{assign var="title" value="Customers lists"}

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

                        <form class="form-ajax mb-3" action="{route path=$route}" method="POST"
                            enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="form-label" for="elm_group">{$lang.text_user_group}</label>
                                
                                <select class="form-control" name="group" id="group">
                                    <option>{$lang.text_none}</option>
                                    {if $groups}
                                        {foreach from=$groups item=item key=key}
                                        <option value="{$item.id}" {if !empty($user) && $user.role_id eq $item.id} selected {/if}>{$item.name}</option>
                                        {/foreach}
                                    {/if}
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="elm_firstname">{$lang.text_firstname}</label>

                                <input type="text" name="firstname" {if !empty($user)} value="{$user.firstname}" {/if} id="firstname" class="form-control" />
                                {if !empty($smarty.request.user_id)}
                                    <input type="hidden" name="user_id" value="{$smarty.request.user_id}" class="form-control" />
                                {/if}
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="elm_lastname">{$lang.text_lastname}</label>
                                <input id="lastname" type="lastname" {if !empty($user)} value="{$user.lastname}" {/if}  class="form-control" name="lastname" />
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="elm_email">{$lang.text_email}</label>
                                <input id="email" type="email" {if !empty($user)} value="{$user.email}" {/if}  class="form-control" name="email" />
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="elm_phone">{$lang.text_phone}</label>
                                <input id="phone" type="phone" {if !empty($user)} value="{$user.phone}" {/if}  class="form-control" name="phone" />
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="elm_password">{$lang.text_password}</label>
                                <input id="password" type="password" class="form-control" name="password" />
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="elm_confirm_password">{$lang.text_confirm_password}</label>
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password" />
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="elm_user_status">{$lang.text_status}</label>
                                <select class="form-control" name="user_status" id="elm_user_status">
                                    <option value="A" {if !empty($user) && $user.active == 'A'} selected {/if}>{$lang.text_enabled}</option>
                                    <option value="D" {if !empty($user) && $user.active == 'D'} selected {/if}>{$lang.text_disabled}</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit"
                                    name="button">{$lang.text_btn_save}</button>
                            </div>
                        </form>
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