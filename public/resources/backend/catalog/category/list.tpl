{capture assign='main_content'}

    {include file="backend/DataGrid/data-grid.tpl" 
        data=$lists 
        name="category" 
        saved_search_name="my_search"
        search_form_dispatch="admin.php?dispatch=catalog.category"
        export=true 
        dispatch="admin.php?dispatch=catalog.category" 
        search_label="Search"     
        product_search_form_prefix="category"
        column_width=[10,20,20,30]
    }
{/capture}
{include file="backend/layouts/layout.tpl"}