{$c_url=fn_url('','A')}
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="navbar-nav flex-row " style="justify-content: right;gap: 10px;">
        
        <div class="">

        {if !empty($smarty.get.q)}  
            <a href="{fn_query_remove($c_url, ['q'])}" class="btn btn-sm p-1 btn-dark"><i class="bx bx-search"></i>&nbsp;{$smarty.get.q}<i class="bx bx-x"></i></a>
        {/if}
        {if !empty($smarty.get.filters)}
            <a href="{fn_link($dispatch)}" class="btn btn-sm p-1 btn-danger">
                {'clear filter'}&nbsp;<i class="bx bx-x"></i>
            </a>            
        {/if}
        
        </div>
        <div class="navbar-nav flex-row align-items-center ms-auto pb-2" style="gap: 10px;">
            {* Get advanced search *}
            {* {if !empty($smarty.get.filters) || !empty($smarty.get.q)}
            <div class="d-flex gap-2" style="justify-content: flex-end;">
                <button type="submit" class="btn btn-primary btn-sm p-1" id="save_search">{'Save Search'}</button>
                <input type="text" name="view" placeholder="Search name" class="form-control"  style="width: 38%;height: 35px;"/>
            </div>
            {/if} *}
            {include file="backend/DataGrid/components/search/search.tpl"
                search=$search
                dispatch=$search_form_dispatch
                type="search_filters"
                autofocus=false
                saved_search_name=$saved_search_name
                form_meta="search-filters-advanced-search__form"
                show_search_button=false
            }
            
            {if $data.records && $export}
                {capture assign="dropdown"}
                    <a class="dropdown-item" href="{"`$c_url`&export=1&format=csv"}">{$lang.export_csv}</a>
                    <a class="dropdown-item" href="{"`$c_url`&export=1&format=xml"}">{$lang.export_xml}</a>
                {/capture}        
                {include file="backend/common/dropdown.tpl" icon="bx-upload" text=$lang.text_export btn_class="btn-primary"}

            {/if}
            {if !empty($data.mass_actions)}
                {assign var="isMassActionOptions" value=false}
                {foreach from=$data.mass_actions item=action}            
                    {if !empty($action.options)}
                        {assign var="isMassActionOptions" value=true}
                        {capture assign="dropdown"}
                            {foreach from=$action.options item=item}
                                {if $item.type eq "update"}                            
                                    <a class="dropdown-item" type="list" dispatch="{$item.value}" class="{$action.class}" href="{$item.value}" form="{$name}">{$item.label}</a>
                                {elseif $item.type eq "delete"}                            
                                    <a class="dropdown-item" type="delete_selected" dispatch="{$item.value}" href="{$item.value}" form="{$name}">{$item.label}</a>
                                {elseif $item.type eq "list"}                            
                                    <a class="dropdown-item" href="{$item.value}">{$item.label}</a>
                                {/if}
                        
                            {/foreach}
                        {/capture}        
                        {else}
                            {if $action.method eq "POST"} 
                                {include file="backend/common/buttons/button.tpl"
                                    but_text="`$action.title`"
                                    but_role="`$action.type`"
                                    but_name="dispatch[`$action.dispatch`]"
                                    but_meta="`$action.class`"
                                    but_target_form="`$name`"
                                    but_href="`$action.dispatch`"
                                    but_icon="`$action.icon`"
                                }
                            {else}
                                {include file="backend/common/buttons/button.tpl"
                                    but_text="`$action.title`"
                                    but_role="`$action.type`"
                                    but_name="`$action.title`"
                                    but_meta="`$action.class`"                        
                                    but_href="`$action.dispatch`"
                                    but_icon="`$action.icon`"
                                }
                            {/if}
                        {/if}
                    {/foreach}
                    {if $isMassActionOptions}
                        {include file="backend/common/dropdown.tpl" text=$lang.text_more btn_class="btn-dark"}
                    {/if}
            {/if}
            {if !empty($data.records) && !empty($is_editable)}                
                {include file="backend/common/save.tpl"
                    but_name="dispatch[`$dispatch`.m_save]"
                    but_role="submit-button"
                    but_target_form="`$name`"
                    but_meta="cm-submit"
                }
            {/if}
        </div>
        </div>
        {* table structure *}
        <div class="card mt-4">
            <div class="table-responsive text-nowrap">
            <form action="{$c_url}" method="post" name="{$name}" id="{$name}" data-ca-main-content-selector="[data-ca-main-content]">   
                {if $data.records}
                    <table width="100%"
                        class="table table-middle table--relative table-responsive table--overflow-hidden table--show-checkbox table-manage-orders">
                        <thead data-ca-bulkedit-default-object="true" data-ca-bulkedit-component="defaultObject">
                            {include file="backend/DataGrid/components/table/head.tpl" columns=$data.columns column_width=$column_width}
                        </thead>

                        <tbody>
                            {include file="backend/DataGrid/components/table/body.tpl" columns=$data column_width=$column_width}
                        </tbody>

                    </table>

                {else}
                    <p class="no-items">{$lang.no_data}</p>
                {/if}
            </form>
            </div>
        </div>
        {* end *}

        {include file="backend/common/pagination.tpl" save_current_page=true save_current_url=true div_id=''}
    
</div>