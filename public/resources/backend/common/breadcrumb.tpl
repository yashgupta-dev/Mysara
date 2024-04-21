{$path = $route}

{assign var="lists" value="."|explode:$route}

<h4 class="py-3 mb-4">
    <span class="text-muted fw-light"><a href="{route path="admin.php?dispatch=dashboard"}">{'Home'}</a></span>        
    {foreach from=$lists item=item}
        
        {if $item@last}
            /{$item}
        {else}
            <span class="text-muted fw-light">/
                <a href="{route path='admin.php?dispatch='|cat:$smarty.request.dispatch}">{$item}</a>
            </span>        
        {/if}
    {/foreach}
</h4>