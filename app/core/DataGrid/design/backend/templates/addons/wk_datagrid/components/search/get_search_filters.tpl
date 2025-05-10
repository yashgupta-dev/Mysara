{*
    Import
    ---
    $search
    $dispatch
    $type
    $show_search_button
*}

{* Search filters params *}
{$search_filters = [
    form_id => $form_id,
    dispatch => $dispatch,
    page_part => $page_part,
    search_form_prefix => $product_search_form_prefix,
    search_type => $search_type,
    selected_section => $selected_section,
    advanced_search => $advanced_search,
    data => []
]}


{* Content for search forms *}

{* Export *}
{$search_filters = $search_filters scope=parent}
