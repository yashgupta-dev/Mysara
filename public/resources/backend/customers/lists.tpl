{capture assign='main_content'}

    {include file="backend/DataGrid/data-grid.tpl" 
        data=$lists 
        name="customers" 
        saved_search_name="customer"
        search_form_dispatch="customers"
        export=true 
        dispatch="customers" 
        search_label="Search"     
        product_search_form_prefix="customer"
        column_width=[10,20,20,30]
    }
{/capture}
{include file="backend/layouts/layout.tpl"}