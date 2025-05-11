{assign var="type" value=$type|default:"default"}
{assign var="search_label" value=$search_label|default:""}
{assign var="autofocus" value=($autofocus === false) ? false : true}
{assign var="filter_request" value=$smarty.request.filters|default:[]}
<button type="button" data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-{if !empty($color)}{$color}{else}dark{/if} btn-md p-1">
    <i class="bx bx-filter-alt"></i>{'Filter'}
</button>
<div class="modal rightModal fade " id="filter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{fn_link($dispatch)}" name="{$product_search_form_prefix}_search_form" method="get" class="{$form_meta}" id="{$product_search_form_prefix}search_form">
                    <input type="hidden" name="type" value="{$search_type|default:"simple"}" {if $autofocus}autofocus="autofocus"{/if} />
                    <input type="hidden" name="dispatch" value="{$dispatch}" />
                    
                    <div class="form-group mb-3">
                        <label for="q">{$lang.text_find_results_with}</label>
                    <input type="text" name="q" id="q" value="{if !empty($search.q)}{$search.q}{/if}" size="50" class="form-control" placeholder="{$search_label}"/>
                    </div>

                    <div class="">
                        {assign var="i" value=0}
                        {foreach $data.columns as $column}
                            {if $column.filterable}
                                {assign var="field_name" value=$column.index}
                                {assign var="field_id" value=$field_name|replace:"?:" : ""|replace:".":"_"}
                                {assign var="filter_value" value=$filter_request[$field_name]|default:''}

                                {if not (in_array($column.type, ["date", "datetime"]) || in_array($column.filterable_type, ["date_range", "datetime_range"]))}
                                    {if $column.filterable_type == "dropdown" || ($column.type == "boolean" && is_array($column.filterable_options))}
                                        {include file="backend/DataGrid/components/search/components/dropdown.tpl"}
                                    {else}
                                        {include file="backend/DataGrid/components/search/components/text.tpl"}
                                    {/if}
                                {/if}
                            {/if}
                        {/foreach}
                    </div>

                    {foreach $data.columns as $column}
                        {if $column.filterable}
                            {assign var="field_name" value=$column.index}
                            {assign var="field_id" value=$field_name|replace:"?:" : ""|replace:".":"_"}
                            {assign var="filter_value" value=$filter_request[$field_name]|default:''}

                            {if in_array($column.type, ["date", "datetime"]) || in_array($column.filterable_type, ["date_range", "datetime_range"])}
                                <div class="group form-horizontal">
                                    <div class="control-group">                            
                                        <label class="control-label" for="filter_{$field_id}">{$column.label}:</label>
                                        <div class="controls">
                                            {assign var="period" value=$search.period|default:""}
                                            {include file="backend/DataGrid/components/search/components/date.tpl" form_name="{$product_search_form_prefix}search_form"}
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        {/if}
                    {/foreach}                    
                    

                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

            </div>
        </div>
    </div>
</div>
