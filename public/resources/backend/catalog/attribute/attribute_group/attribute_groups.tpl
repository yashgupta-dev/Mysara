
{capture assign='main_content'}

                    <div class="container-xxl flex-grow-1 container-p-y">
                        {* {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch} *}

                        {include file="backend/common/filter.tpl" title='Filter' content="backend/catalog/attribute/attribute_group/components/filter.tpl"}

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
                                    {foreach from=$lists item=list key=key}
                                        <tr>
                                            <td scope="row">
                                                <input type="checkbox" value="{$list.attribute_group_id}" name="ids" id="list_ids"/>                                                    
                                            </td>
                                            <td>{$list.name}</td>
                                            <td>{$list.sort_order}</td>
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
                                            <td colspan="4" class="text-center">{$lang.text_no_result}</td>
                                        </tr>

                                    {/foreach}
                                    </tbody>

                                </table>
                            </div>
                            {* form end *}

                        </div>

                        {include file="backend/common/pagination.tpl" save_current_page=true save_current_url=true div_id=''}

                    </div>

{/capture}
{include file="backend/layouts/layout.tpl"}