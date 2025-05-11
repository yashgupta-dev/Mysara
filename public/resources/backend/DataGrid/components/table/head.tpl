
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
        <tr>        
        <th class="left mobile-hide table__check-items-column table__check-items-column--show-checkbox">            
            <input type="checkbox"
                class="bulkedit-toggler hide"
                data-ca-bulkedit-disable="[data-ca-bulkedit-default-object=true]"
                data-ca-bulkedit-enable="[data-ca-bulkedit-expanded-object=true]"
            />
        </th>
        
        {foreach from=$columns item=column key=index}
            
            {if $column.visibility}
                
                <th width="{$column_width[$index]|default:10}%" data-th="{$column.label}">
                    {if $column.sortable}
                        {include file="backend/common/table_col_head.tpl" type=$column.index text=$column.label}
                    {else}
                        {include file="backend/common/table_col_head.tpl" text=$column.label}
                    {/if}
                </th>        
                
            {/if}
        {/foreach}
        </tr>
    {/if}