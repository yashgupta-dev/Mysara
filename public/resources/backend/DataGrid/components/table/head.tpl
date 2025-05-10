
{*
    Sort link for table column
    ---
    $columns = [
        index as field
        label as name
        type  as dataType
        sortable as boolean
        visibility as boolean
    ]
*}
{if !empty($columns)}
    {hook name="wk_datagrid:table_head"}
        <tr>
        {hook name="wk_datagrid:table_head_checkbox"}
        <th class="left mobile-hide table__check-items-column table__check-items-column--show-checkbox">            
            <input type="checkbox"
                class="bulkedit-toggler hide"
                data-ca-bulkedit-disable="[data-ca-bulkedit-default-object=true]"
                data-ca-bulkedit-enable="[data-ca-bulkedit-expanded-object=true]"
            />
        </th>
        {/hook}
        
        {foreach from=$columns item=column key=index}
            
            {if $column.visibility}
                {hook name="wk_datagrid:head_column_`$column.index`"}
                <th width="{$column_width[$index]|default:10}%" data-th="{$column.label}">
                    {if $column.sortable}
                        {include file="backend/common/table_col_head.tpl" type=$column.index text=$column.label}
                    {else}
                        {include file="backend/common/table_col_head.tpl" text=$column.label}
                    {/if}
                </th>        
                {/hook}
            {/if}
        {/foreach}
        </tr>
    {/hook}
    {/if}