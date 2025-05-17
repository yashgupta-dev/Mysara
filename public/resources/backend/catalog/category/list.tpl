{capture assign='main_content'}

    {include file="backend/DataGrid/data-grid.tpl" 
        data=$lists 
        name="category" 
        saved_search_name="categories"
        search_form_dispatch="catalog.category"
        export=true 
        dispatch="catalog.category" 
        search_label="Search"     
        product_search_form_prefix="category"
        column_width=[30,20,20,20]
        is_editable=true
    }
{/capture}
{include file="backend/layouts/layout.tpl"}