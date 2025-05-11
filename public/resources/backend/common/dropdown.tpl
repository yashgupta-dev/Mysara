{assign var="text" value=$text|default:''}
{assign var="icon" value=$icon|default:''}
{assign var="btn_class" value=$btn_class|default:'btn-primary'}

<div class="dropdown">
    <button type="button" class="btn {$btn_class} btn-md p-1 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        {if $icon}<i class="bx {$icon}"></i>&nbsp;{/if}{$text}&nbsp;<i class="bx bx-chevron-down"></i>
    </button>
    <div class="dropdown-menu" data-popper-placement="top-end">
        {$dropdown|default}
    </div>
</div>