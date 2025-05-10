{capture name="tools_list"}                             
    {foreach from=$actions item=action}
        {if $action.method eq "GET"}
            <li>{btn type="list" text=$action.title href="`$action.url`"}</li>
        {else}
            <li>
            {btn type="`$action.type`"
                text=$action.title
                class="`$action.class`"
                href="`$action.url`"
                method=$action.method
            }
            </li>
        {/if}
    {/foreach}
{/capture}
{dropdown content=$smarty.capture.tools_list}