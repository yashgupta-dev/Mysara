{assign var="text" value=$but_text|default:$lang.text_save_btn}
{assign var="but_name" value=$but_name|default:''}
{assign var="icon" value=$but_icon|default:''}
{assign var="but_role" value=$but_role|default:'button'}
{assign var="but_target_form" value=$but_target_form|default:''}
{assign var="but_meta" value=$but_meta|default:''}
{assign var="but_href" value=$but_href|default:''}

{if $but_role == "submit-button"}
    <button type="submit" class="btn btn-primary btn-md btn-md p-1 {$but_meta}" name="{$but_name}" form="{$but_target_form}">
        {if $icon}<i class="bx {$icon}"></i>&nbsp;{/if}{$text}
    </button>

{elseif $but_role == "button"}
    <button type="button" class="btn btn-secondary btn-md btn-md p-1 {$but_meta}" name="{$but_name}">
        {if $icon}<i class="bx {$icon}"></i>&nbsp;{/if}{$text}
    </button>

{elseif $but_role == "button-icon"}
    <button type="button" class="btn btn-icon btn-md btn-md p-1 {$but_meta}" name="{$but_name}" title="{$text}">
        {if $icon}<i class="bx {$icon}"></i>{/if}
    </button>

{elseif $but_role == "action"}
    <a href="{$but_href}" class="btn btn-primary btn-md btn-md p-1 {$but_meta}" name="{$but_name}">
        {if $icon}<i class="bx {$icon}"></i>&nbsp;{/if}{$text}
    </a>
{/if}
