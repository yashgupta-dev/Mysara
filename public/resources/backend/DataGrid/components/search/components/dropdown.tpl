<div class="form-group  mb-2">
    <label for="filter_{$field_id}" >{$column.label}:</label>
    <select name="filters[{$field_name}]" id="filter_{$field_id}" class="form-control">
        <option value="">--</option>
        {foreach from=$column.filterable_options item=option}
            <option value="{$option.value}" {if $filter_value == $option.value}selected{/if}>
                {$option.label}
            </option>
        {/foreach}
    </select>
</div>