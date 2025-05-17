{capture assign='main_content'}

    {include file="backend/DataGrid/data-grid.tpl" 
        data=$lists 
        name="users" 
        saved_search_name="users"
        search_form_dispatch="system.users"
        export=true 
        dispatch="system.users" 
        search_label="Search"     
        product_search_form_prefix="users"
        column_width=[15,20,20,20,20]
        is_editable=false
    }
{/capture}
{include file="backend/layouts/layout.tpl"}