{assign var="title" value="{$lang.text_heading}"}

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
                        {include file="backend/common/filter.tpl" title="Filter" content="backend/customers/components/filter.tpl"}
                        
                        <!-- Responsive Table -->
                        <div class="card">                            
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th><input type="checkbox" onclick="$(document).find('#customer_ids').attr('checked',true);"/> </th>
                                            <th>{$lang.column_name}</th>
                                            <th>{$lang.column_email}</th>
                                            <th>{$lang.column_phone}</th>
                                            <th>{$lang.column_status}</th>
                                            <th>{$lang.column_created_at}</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {foreach from=$customers item=customer key=key}
                                            <tr>
                                                <td scope="row">
                                                    <input type="checkbox" value="{$customer.id}" name="ids" id="customer_ids"/>                                                    
                                                </td>
                                                <td>{$customer.name}</td>
                                                <td><a href="mailto:{$customer.email}">{$customer.email}</a></td>
                                                <td><a href="tel:{$customer.phone}">{$customer.phone}</a></td>
                                                
                                                <td>{$func->fn_get_status($customer.active)}</td>
                                                {* <td>{$customer.profile_id}</td> *}
                                                <td>{$func->fn_get_human_readable_date('d M, Y h:i:s',$customer.created_at)}</td>
                                                {* <td>{$func->fn_get_human_readable_date('d M, Y h:i:s',$customer.updated_at)}</td> *}
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                        <div class="dropdown-menu"  data-popper-placement="top-end">
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> {$lang.text_edit}</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> {$lang.text_delete}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        {foreachelse}
                                            <tr>
                                                <td colspan="7" class="text-center">{$lang.text_no_result}</td>
                                            </tr>

                                        {/foreach}
                                        
                                    </tbody>
                                </table>
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