    {foreach from=$data.records item="result" key=index}
        <tr class="cm-longtap-target"
            data-ca-longtap-action="setCheckBox"
            data-ca-longtap-target="input.cm-item"
            data-ca-id="{$result[$data.meta.primary_column]}">            
            
                <td width="3%" class="left mobile-hide table__check-items-cell table__check-items-cell--show-checkbox">
                    <input type="checkbox" class="row-checkbox cm-item" name="{$data.meta.primary_column}[]" value="{$result[$data.meta.primary_column]}"/>
                </td>
            

            {foreach from=$data.columns item=column key=index}
                {* split from . *}
                {assign var=index_name value="."|explode:$column.index|default:$column.index}
                {if !empty($index_name[1])}
                    {assign var=index_name value=$index_name[1]}
                {else}
                    {assign var=index_name value=$column.index}
                {/if}
                
                {if $column.visibility}                   

                    <td width="{$column_width[$index]|default:10}%" data-th="{$column.label}">
                        {if $column.type eq 'date'}
                            {fn_get_human_readable_date('d M, Y',$result[$index_name])}
                        {elseif $column.type eq 'datetime'}
                            {fn_get_human_readable_date('d M, Y h:i:s',$result[$index_name])}
                        {elseif $column.type eq 'time'}
                            {fn_get_human_readable_date('d M, Y h:i:s',$result[$index_name])}
                        {else}
                            {$result[$index_name]}
                        {/if}
                        {if $column.is_editable}
                            <input type="text" name="update_data[{$result[$data.meta.primary_column]}][{$column.index}]" size="6" value="{$result[$index_name]}" class="input-small input-hidden" data-a-sep />
                        {/if}
                    </td>

                {/if}
                
            {/foreach}
            {if !empty($result.actions)}                
                <td class="center" data-th="{$lang.tools}">
                    {include file="backend/DataGrid/components/actions.tpl" actions=$result.actions}
                </td>

            {/if}
        </tr>
        
    {/foreach}
