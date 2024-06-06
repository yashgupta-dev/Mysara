{assign var="id" value=$div_id|default:"pagination_contents"}
{assign var="c_url" value=$current_url|default:$smarty.request.dispatch}
{assign var="pagination" value=$func->fn_generate_pagination($search)}

{$show_pagination_open = $show_pagination_open|default:true}
{$show_pagination_open = $show_pagination_open scope=parent}

{if $smarty.capture.pagination_open == "Y"}
    {assign var="pagination_meta" value=" paginate-top"}
{/if}

{if $smarty.capture.pagination_open != "Y"}
    <div class="cm-pagination-container" id="{$id}">
    {/if}

    {if $pagination}

        {* {math equation=min($pagination.per_page_range) assign="per_page_range"} *}
        {assign var="min_per_page_range" value=$pagination.per_page_range|min}

        {if $save_current_page}
            <input type="hidden" name="page" value="{$search.page|default:$smarty.request.page|default:1}" />
        {/if}

        {if $save_current_url}
            <input type="hidden" name="redirect_url" value="{$config->get('current_url')}" />
        {/if}

        {if $smarty.capture.pagination_open !== "Y" && $show_pagination_open || $smarty.capture.pagination_open === "Y"}
            <div class="pagination-wrap clearfix">

                {* Left buttons *}

                {if $pagination.total_items > $min_per_page_range}

                    <div class="pagination pagination-start">
                        <ul>
                            {if $pagination.current_page != "full_list" && $pagination.total_pages > 0}
                                {* Button "<<" *}
                                <li class="{if !$pagination.prev_page}disabled{/if} mobile-hide">
                                    <a data-ca-scroll=".cm-pagination-container"
                                        class="{if $pagination.prev_page}cm-ajax{/if} pagination-item" {if $pagination.prev_page}
                                    href="{$func->fn_url('&page=1')}" data-ca-page="1" data-ca-target-id="{$id}" {/if}>
                                    <i class='bx bx-chevrons-left'></i>
                                </a>
                            </li>

                            {* Button "<" *}
                            <li class="{if !$pagination.prev_page}disabled{/if}">
                                <a data-ca-scroll=".cm-pagination-container"
                                    class="{if $pagination.prev_page}cm-ajax{/if} pagination-item" {if $pagination.prev_page}
                                    href="{$func->fn_url("&page=`$pagination.prev_page`")}" data-ca-page="{$pagination.prev_page}"
                                data-ca-target-id="{$id}" {/if}>
                                <i class='bx bx-chevron-left'></i>
                            </a>
                        </li>
                    {/if}
                </ul>
            </div>

            {* Dropdown button *}
            <div class="pagination-dropdown">
                <div class="btn-group ">
                    <a class="pagination-selector btn dropdown-toggle" data-bs-toggle="dropdown">
                        <span>{$pagination.range_from}</span>–<span>{$pagination.range_to}</span>&nbsp;of&nbsp;{$pagination.total_items}
                        <span class="caret"></span> </a>
                    {foreach from=$pagination.navi_pages item="pg" name="f_pg"}

                        {if $pg == $pagination.current_page}
                            {* {capture name="pagination_list"} *}

                                {assign var="range_url" value=$func->fn_query_remove("items_per_page")}
                                <ul id="tools_list_pagination_1535942676" class="dropdown-menu dropdown-menu-end cm-smart-position">
                                    {foreach from=$pagination.per_page_range item="step"}
                                        <li>
                                            <a data-ca-scroll=".cm-pagination-container" class="dropdown-item cm-ajax pagination-dropdown-per-page"
                                                href="{$func->fn_url("&items_per_page=`$step`")}" data-ca-target-id="{$id}">
                                                {$step} {$lang.text_per_page}
                                            </a>
                                        </li>
                                    {/foreach}
                                </ul>

                            {/if}
                        {/foreach}
                    </div>
                </div>

                {* Right buttons *}
                <div class="pagination pagination-end">
                    <ul>
                        {if $pagination.current_page != "full_list" && $pagination.total_pages > 0}

                            {* Button ">" *}
                            <li class="{if !$pagination.next_page}disabled{/if} pagination-item">
                                <a data-ca-scroll=".cm-pagination-container"
                                    class="{if $pagination.next_page}cm-ajax{/if} pagination-item" {if $pagination.next_page}
                                    href="{$func->fn_url("&page=`$pagination.next_page`")}" data-ca-page="{$pagination.next_page}"
                                data-ca-target-id="{$id}" {/if}>
                                <i class='bx bx-chevron-right'></i>
                            </a>
                        </li>

                        {* Button ">>" *}
                        <li class="{if !$pagination.next_page}disabled{/if} mobile-hide">
                            <a data-ca-scroll=".cm-pagination-container"
                                class="{if $pagination.next_page}cm-ajax{/if} pagination-item" {if $pagination.next_page}
                                href="{$func->fn_url("&page=`$pagination.total_pages`")}"
                            data-ca-page="{$pagination.total_pages}" data-ca-target-id="{$id}" {/if}>
                            <i class='bx bx-chevrons-right'></i>
                        </a>
                    </li>
                {/if}
            </ul>
        </div>
        {/if}

    </div>
    {/if}
    {/if}

    <!--{$id}-->
</div>