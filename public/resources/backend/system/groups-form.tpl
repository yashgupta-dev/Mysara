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

                        <form class="form-ajax mb-3" action="{route path=$route}" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="form-label" for="input-name">{'Name'}</label>

                                    <input type="text" name="name" value="{if !empty($groups)}{$groups.name}{/if}" id="input-name"
                                    class="form-control" />
                                    {if !empty($smarty.request.group_id)}
                                    <input type="hidden" name="id" value="{$smarty.request.group_id}" class="form-control" />
                                    {/if}

                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{'Access Permissions'}</label>
                                <div class="form-control">
                                    <div class="well well-sm" style="height: 150px; overflow: auto;">

                                        {foreach from=$permissions item=permission key=key}

                                            <div class="checkbox">
                                                <label>
                                                    {if !empty($access) && !empty($access.access) && in_array($permission,$access.access)}
                                                        <input type="checkbox" name="permission[access][]" value="{$permission}"
                                                            checked="checked" />
                                                        {$permission}
                                                    {else}
                                                        <input type="checkbox" name="permission[access][]" value="{$permission}" />
                                                        {$permission}
                                                    {/if}
                                                </label>
                                            </div>
                                        {/foreach}
                                    </div>
                                    <button type="button"
                                        onclick="$(this).parent().find(':checkbox').prop('checked', true);"
                                        class="btn btn-link">{'Select all'}</button> / <button type="button"
                                        onclick="$(this).parent().find(':checkbox').prop('checked', false);"
                                        class="btn btn-link">{'Unselect all'}</button>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">{'Modify Permissions'}</label>
                                <div class="form-control">
                                    <div class="well well-sm" style="height: 150px; overflow: auto;">

                                        {foreach from=$permissions item=permission key=key}

                                            <div class="checkbox">
                                                <label>
                                                    {if !empty($access) && !empty($access.modify) && in_array($permission,$access.modify)}
                                                        <input type="checkbox" name="permission[modify][]" value="{$permission}"
                                                            checked="checked" />
                                                        {$permission}
                                                    {else}
                                                        <input type="checkbox" name="permission[modify][]" value="{$permission}" />
                                                        {$permission}
                                                    {/if}
                                                </label>
                                            </div>
                                        {/foreach}
                                    </div>
                                    <button type="button"
                                        onclick="$(this).parent().find(':checkbox').prop('checked', true);"
                                        class="btn btn-link">{'Select all'}</button> / <button type="button"
                                        onclick="$(this).parent().find(':checkbox').prop('checked', false);"
                                        class="btn btn-link">{'Unselect all'}</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" name="button">{'Save changes'}</button>
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