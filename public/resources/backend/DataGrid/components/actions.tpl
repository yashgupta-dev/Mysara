       
<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="bx bx-cog"></i>
    </button>                 
    <div class="dropdown-menu"  data-popper-placement="top-end">
    {foreach from=$actions item=action}
        {if $action.method eq "GET"}                
            <a class="dropdown-item {$action.class|default:''}" href="{$action.url|default:'javascript:;'}"><i class="bx {$action.icon|default:''}"></i> {$action.title|default:''}</a>
        {else}
            <a class="dropdown-item {$action.class|default:''}" data-request-method="{$action.method|default:'POST'}" data-form="{$name}" href="{$action.url|default:'javascript:;'}"><i class="bx {$action.icon|default:''}"></i> {$action.title|default:''}</a>            
        {/if}
    {/foreach}
    </div>
</div>
