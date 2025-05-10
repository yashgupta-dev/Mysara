{hook name="wk_datagrid:table_body"}
    {foreach from=$data.records item="result" key=index}                    
        <tr class="cm-longtap-target"
            data-ca-longtap-action="setCheckBox"
            data-ca-longtap-target="input.cm-item"
            data-ca-id="{$result[$data.meta.primary_column]}">
            
            {hook name="wk_datagrid:table_body_checkbox"}
                <td width="3%" class="left mobile-hide table__check-items-cell table__check-items-cell--show-checkbox">
                    <input type="checkbox" name="{$data.meta.primary_column}[]" value="{$result[$data.meta.primary_column]}" class="cm-item"/>
                </td>
            {/hook}

            {foreach from=$data.columns item=column key=index}
                {* split from . *}
                {assign var=index_name value="."|explode:$column.index}
                {if $column.visibility}
                    {hook name="wk_datagrid:body_column_`$index_name[1]`"}

                    <td width="{$column_width[$index]|default:10}%" data-th="{$column.label}">
                        {if $column.type eq 'date'}
                            {$result[$index_name[1]]|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}
                        {elseif $column.type eq 'datetime'}
                            {$result[$index_name[1]]|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}
                        {elseif $column.type eq 'time'}
                            {$result[$index_name[1]]|date_format:"`$settings.Appearance.time_format`"}
                        {else}
                            {$result[$index_name[1]]}
                        {/if}
                        {if $column.is_editable}
                            <input type="text" name="update_data[{$result[$data.meta.primary_column]}][{$column.index}]" size="6" value="{$result[$index_name[1]]}" class="input-small input-hidden" data-a-sep />
                        {/if}
                    </td>

                    {/hook}
                {/if}
                
            {/foreach}
            {if !empty($result.actions)}
                {hook name="wk_datagrid:body_column_actions"}
                <td class="center" data-th="{__("tools")}">
                    {include file="addons/wk_datagrid/components/actions.tpl" actions=$result.actions}
                </td>
                {/hook}
            {/if}
        </tr>
        
    {/foreach}
{/hook}