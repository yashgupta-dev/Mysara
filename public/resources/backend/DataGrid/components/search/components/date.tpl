<div class="control-group">        
    <div class="controls" id="filter_{$field_id}">
        <div class="nowrap">
            <div class="form-inline">            
            {include file="backend/DataGrid/components/search/components/period_selector.tpl" period=$filter_value.period form_name="$form_meta"}
            </div>
        </div>
    </div>
</div>

<style>
.form-horizontal .controls#filter_{$field_id} {
    margin-left: 0;
}
.ty-period {
    display: flex;
    justify-content: space-around;
}

.ty-period .ty-control-group {
    display: flow-root;
    padding: 0 30px 0 0;
}
</style>