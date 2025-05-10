{*
    $search_form_dispatch: current url

    $page_title: page title

    $search_form_prefix: search form prefix

    $content_id : content id

    $name : form name

    $data : get results data 

    $column_width : column width

    $search_label : search label

    $show_search_button: show search button

*}
{capture name="mainbox"}    

    {capture name="sidebar"}        
        {* {include file="common/saved_search.tpl" dispatch="$search_form_dispatch" view_type="$saved_search_name"} *}
    {/capture}
    <form action="{""|fn_url}" method="post" name="{$name}" id="{$name}" data-ca-main-content-selector="[data-ca-main-content]">
        {include file="backend/common/pagination.tpl" save_current_page=true save_current_url=true div_id=$smarty.request.content_id}
        
        {$c_url=$config.current_url|fn_query_remove:"sort_by":"sort_order"}
        {$rev = $smarty.request.content_id|default:"pagination_contents,content_top_navigation"}
        {$extra_status=$config.current_url|escape:"url"}

        {* table structure *}
        <div class="table-responsive-wrapper longtap-selection">
        {if $data.records}
            {hook name="wk_datagrid:table"}
                <table width="100%" class="table table-middle table--relative table-responsive table--overflow-hidden table--show-checkbox table-manage-orders">
                    <thead data-ca-bulkedit-default-object="true" data-ca-bulkedit-component="defaultObject">
                        {include file="backend/DataGrid/components/table/head.tpl" columns=$data.columns column_width=$column_width}                        
                    </thead>                

                    <tbody>
                        {include file="backend/DataGrid/components/table/body.tpl" columns=$data column_width=$column_width}                        
                    </tbody>
                    
                </table>
            {/hook}
        {else}
            <p class="no-items">{__("no_data")}</p>
        {/if}
        </div>  
        {* end *}

        {include file="backend/common/pagination.tpl" save_current_page=true save_current_url=true div_id=$smarty.request.content_id}
    </form>

{/capture}

{capture name="buttons"}
        {capture name="tools_list"}        
            {foreach from=$data.mass_actions item=action}            
                {if !empty($action.options)}
                    {foreach from=$action.options item=item}
                        {if $item.type eq "update"}
                            <li>{btn type="list" text="`$item.label`" dispatch="dispatch[`$item.value`]" class="`$action.class`" form="`$name`"}</li>
                        {elseif $item.type eq "delete"}
                            <li>{btn type="delete_selected" dispatch="dispatch[`$item.value`]" form="`$name`"}</li>
                        {elseif $item.type eq "list"}
                            <li>{btn type="list" text="`$item.label`" href="`$item.value`"}</li>
                        {/if}
                
                    {/foreach}
                {/if}
            {/foreach}
        {/capture}
        {dropdown content=$smarty.capture.tools_list}

        {if $data.records && $export}
            <div class="btn-bar btn-toolbar nav__actions-bar dropleft" style="margin:0 5px 0 5px;">
                <div class="btn-group dropleft">
                    <a href="#" class="btn dropdown-toggle " data-toggle="dropdown">
                        <span class="btn__icon btn__icon--caret">
                            <span class="cs-icon cs-icon--type-cog dropdown-icon dropdown-icon--tools">
                                <span class="cs-icon__hidden-accessible"></span>
                                <svg fill="currentColor" class="cs-icon__svg" focusable="false" aria-hidden="true" viewBox="0 0 20 20"><path d="m9.99935 2.41669c-4.18816 0-7.58333 3.39517-7.58333 7.58331 0 4.1882 3.39517 7.5834 7.58333 7.5834 4.18815 0 7.58335-3.3952 7.58335-7.5834 0-4.18814-3.3952-7.58331-7.58335-7.58331zm-9.083334 7.58331c0-5.01657 4.066744-9.083313 9.083334-9.083313 5.01655 0 9.08335 4.066743 9.08335 9.083313 0 5.0166-4.0668 9.0834-9.08335 9.0834-5.01659 0-9.083334-4.0668-9.083334-9.0834zm9.083334-4.08331c.19895 0 .38965.07901.53035.21967l3.3333 3.33333c.2929.29289.2929.76781 0 1.06061-.2929.2929-.7678.2929-1.0606 0l-2.0531-2.05295v4.85605c0 .4142-.3357.75-.74995.75-.41422 0-.75-.3358-.75-.75v-4.85605l-2.053 2.05295c-.2929.2929-.76777.2929-1.06066 0-.2929-.2928-.2929-.76772 0-1.06061l3.33333-3.33333c.14065-.14066.33142-.21967.53033-.21967z"></path></svg>
                            </span>
                            {__("export")}
                        </span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu width-100">                        
                        <li>{btn type="list" text=__('wk_nlptosql.export_csv') href="`$c_url`&export=1&format=csv"}</li>
                        <li>{btn type="list" text=__('wk_nlptosql.export_xml') href="`$c_url`&export=1&format=xml"}</li>
                    </ul>
                </div>
            </div>

            
        {/if}
        
        {if $data.records && $is_editable}
            {include file="buttons/save.tpl" but_name="dispatch[`$is_editable`]" but_role="action" but_target_form="`$name`" but_meta="cm-submit"}
        {/if}

        {foreach from=$data.mass_actions item=action}            
            {if empty($action.options)}
                     
                {if $action.method eq "POST"} 
                    {include file="buttons/button.tpl"
                        but_text="`$action.title`"
                        but_role="`$action.type`"
                        but_name="dispatch[`$action.dispatch`]"
                        but_meta="`$action.class`"
                        but_target_form="`$name`"
                        but_href="`$action.dispatch`"
                        but_icon="`$action.icon`"
                    }
                {else}
                    {include file="buttons/button.tpl"
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
    
{/capture}


{* Get advanced search *}
{include file="backend/DataGrid/components/search/search.tpl"
    search=$search
    dispatch=$search_form_dispatch
    type="search_filters"
    autofocus=false
    saved_search_name=$saved_search_name
    form_meta="search-filters-advanced-search__form"
    show_search_button=false
    advanced_search_button_class="btn"
    show_advanced_search_button_icon=true
    show_advanced_search_button_text=false
    assign="wk_datagrid_advance_search_button"
}
<style>
    div.search-filters{
        display: none; /* will come in future */
    }
    @media (max-width: 767px) {
        #{$name} table tbody tr td {
            word-break: break-all;
        }
    }
</style>
{* Get $search_filters, and $context_search *}
{include file="backend/DataGrid/components/search/get_search_filters.tpl"
    search=$search
    dispatch=$search_form_dispatch
    form_id="`$search_form_prefix`search_filters_form"
    type="search_filters"
    advanced_search=$wk_datagrid_advance_search_button
}

{* mainbox *}
{include file="common/mainbox.tpl"
    title=$page_title
    content=$smarty.capture.mainbox
    sidebar=$smarty.capture.sidebar
    buttons=$smarty.capture.buttons
    adv_buttons=$smarty.capture.adv_buttons
    content_id=$content_id
    select_storefront=true
    storefront_switcher_param_name="storefront_id"
    selected_storefront_id=$selected_storefront_id
    search_filters=$search_filters
    context_search=$context_search
}
    