{assign var="title" value=$lang.heading_title}

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

                        <div class="card">
                            <div class="card-body">
                                <form class="form-ajax mb-3" action="{route path="admin.php?dispatch=catalog.attribute.add"}" method="POST">
                                    
                                    <div class="form-group mb-3">
                                        <label for="elm-group-name" class="form-label">{$lang.text_group_name}</label>
                                        <select class="form-control" name="group_id">
                                            <option>{$lang.text_none}</option>
                                            {foreach from=$groups item=item}
                                                <option value="{$item.attribute_group_id}">{$item.name}</option>                                                
                                            {/foreach}
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="elm-name" class="form-label">{$lang.text_name}</label>
                                        <input type="text" class="form-control" id="elm-name" name="name"/>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="elm-sort" class="form-label">{$lang.text_sort}</label>
                                        <input type="text" class="form-control" id="elm-sort" name="sort"/>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit" name="button">{$lang.text_btn_save}</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>

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