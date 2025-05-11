{assign var="sort_by" value=$smarty.get.sort_by|default:''}
{assign var="sort_order" value=$smarty.get.sort_order|default:'asc'}

{assign var="isActive" value=($sort_by == $type|default:'')}
{assign var="newOrder" value=($sort_order == 'asc' && $isActive) ? 'desc' : 'asc'}

{if !empty($type)}
    <a href="{fn_link($dispatch)}{"&sort_by=`$type`&sort_order=`$newOrder`"}">
    {$text}
    {if $isActive}
        <span class="sort-icon">
            {if $sort_order == 'asc'}▲{else}▼{/if}
        </span>
    {/if}
    </a>
{else}
    {$text}
{/if}