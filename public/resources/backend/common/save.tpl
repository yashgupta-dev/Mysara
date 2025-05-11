{assign var="text" value=$but_text|default:$lang.text_save_btn}
{assign var="but_name" value=$but_name|default:''}
{assign var="but_role" value=$but_role|default:'submit-button'}
{assign var="but_target_form" value=$but_target_form|default:''}
{assign var="but_meta" value=$but_meta|default:''}
{assign var="icon" value=$but_icon|default:'bx-save'}

{if $but_role == "submit-button"}
    <button type="submit"
            class="btn btn-primary {$but_meta} btn-md p-1"
            name="{$but_name}"
            form="{$but_target_form}">
            {$text}
    </button>
{/if}
