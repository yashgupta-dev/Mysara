{assign var="type" value=$type|default:"default"}
{assign var="autofocus" value=($autofocus === false) ? false : true}

{if $in_popup}
    <div class="adv-search">
        <div class="group">
{elseif $type !== "search_filters"}
    <div class="sidebar-row">
        <h6>{__("admin_search_title")}</h6>
{/if}

{if $page_part}
    {assign var="_page_part" value="#`$page_part`"}
{/if}

<form action="{""|fn_url}{$_page_part}" name="{$product_search_form_prefix}search_form" method="get" class="{$form_meta}" id="{$product_search_form_prefix}search_form">
    <input type="hidden" name="type" value="{$search_type|default:"simple"}" {if $autofocus}autofocus="autofocus"{/if} />

    {capture name="advanced_search"}
        <div class="sidebar-field">
            <label for="q">{__("find_results_with")}</label>
            <input type="text" name="q" id="q" value="{$search.q}" size="50" style="width: 100%;" placeholder="{$search_label}"/>
        </div>

        {foreach $data.columns as $column}
            {if $column.filterable}
                {assign var="field_name" value=$column.index}
                {assign var="field_id" value=$field_name|replace:"?:" : ""|replace:".":"_"}
                {assign var="filter_value" value=$smarty.request.filters[$field_name]}

                {if in_array($column.type, ["date", "datetime"]) || in_array($column.filterable_type, ["date_range", "datetime_range"])}
                    <div class="group form-horizontal">
                        <div class="control-group">                            
                            <label class="control-label" for="filter_{$field_id}">{$column.label}:</label>
                            <div class="controls">
                                {include file="addons/wk_datagrid/components/search/components/date.tpl" period=$search.period form_name="{$product_search_form_prefix}search_form"}
                            </div>
                        </div>
                    </div>
                {/if}
            {/if}
        {/foreach}

        <div class="row-fluid">
            {assign var="i" value=0}
            {foreach $data.columns as $column}
                {if $column.filterable}
                    {assign var="field_name" value=$column.index}
                    {assign var="field_id" value=$field_name|replace:"?:" : ""|replace:".":"_"}
                    {assign var="filter_value" value=$smarty.request.filters[$field_name]}

                    {if not (in_array($column.type, ["date", "datetime"]) || in_array($column.filterable_type, ["date_range", "datetime_range"]))}
                        {if $i % 3 == 0}
                            {if $i != 0}</div>{/if}
                            <div class="group span4 form-horizontal">
                        {/if}

                        {if $column.filterable_type == "dropdown" || ($column.type == "boolean" && is_array($column.filterable_options))}
                            {include file="addons/wk_datagrid/components/search/components/dropdown.tpl"}
                        {else}
                            {include file="addons/wk_datagrid/components/search/components/text.tpl"}
                        {/if}

                        {assign var="i" value=$i+1}
                    {/if}
                {/if}
            {/foreach}
            {if $i % 3 != 0}</div>{/if}
        </div>
    {/capture}
    
    {include file="common/advanced_search.tpl" simple_search=$smarty.capture.simple_search advanced_search=$smarty.capture.advanced_search dispatch=$dispatch view_type=$saved_search_name in_popup=$in_popup}
</form>

{if $in_popup}
        </div></div>
{elseif $type !== "search_filters"}
    </div><hr>
{/if}
