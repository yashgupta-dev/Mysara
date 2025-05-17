{capture assign='main_content'}

    {include file="backend/DataGrid/data-grid.tpl" 
        data=$lists 
        name="attribute" 
        saved_search_name="my_search"
        search_form_dispatch="catalog.attribute"
        export=true 
        dispatch="catalog.attribute" 
        search_label="Search"     
        product_search_form_prefix="attribute"
        column_width=[30,20,30,20]
    }
{/capture}
{include file="backend/layouts/layout.tpl"}
