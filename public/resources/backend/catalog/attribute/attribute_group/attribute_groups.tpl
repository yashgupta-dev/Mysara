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

                        {include file="backend/common/filter.tpl" title='Filter' content="backend/customers/components/filter.tpl"}

                        {include file="backend/common/btn.tpl" title=$lang.text_list_attribute color="primary" href="admin.php?dispatch=catalog.attribute"}
                        {include file="backend/common/btn.tpl" title=$lang.text_group_attribute_group color="primary" href="admin.php?dispatch=catalog.group.add"}

                        <!-- Responsive Table -->
                        {include file="backend/common/pagination.tpl" save_current_page=true save_current_url=true div_id=''}

                        {* form start*}

                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>
                                                <input type="checkbox"
                                                    onclick="$(document).find('#customer_ids').attr('checked',true);" />
                                            </th>
                                            <th>{$lang.column_name}</th>
                                            <th>{$lang.column_sort}</th>                                            
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            {* form end *}

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