<div class="form-group  mb-2">        
    <div class="controls" id="filter_{$field_id}">
        <div class="nowrap">
            <div class="form-inline">            
            {include file="backend/DataGrid/components/search/components/period_selector.tpl" period=$filter_value.period|default:'' form_name="$form_meta"}
            </div>
        </div>
    </div>
</div>