<div class="card mb-4">
    <h5 class="card-header">{$lang.text_recent_devices}</h5>
    <!-- Recent Decvice -->
    <div class="card-body">
        <span>{$lang.text_browser_session}</span>
        <div class="mt-4 space-y-6">
            <!-- Other Browser Sessions -->
            {foreach from=$sesisons item=item key=key}
                <div class="d-flex mb-3">
                    {$agent = getAgentInfo($item.user_agent)}
                    <div class="device-style">
                        {if $agent.device == 'D'}
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-8 h-8 text-gray">
                                <path
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        {else}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray">
                                <path d="M0 0h24v24H0z" stroke="none"></path>
                                <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                                <path d="M11 5h2M12 17v.01"></path>
                            </svg>
                        {/if}
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray" style="font-family: system-ui;">
                            {$agent.platform} - {$agent.browser}
                        </div>
                        <div>
                            <div class="text-xs text-gray" style="font-family: system-ui;">
                                {$item.ip_address},
                                {if $current_session_id == $item.id}
                                    <span class="text-success font-semibold">
                                        {$lang.text_this_device}
                                    </span>
                                {else}
                                    {$lang.text_last_activity} {getTimeDiff($item.last_activity)}
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
            {/foreach}

        </div>

    </div>

    <div class="card-footer bg-light">
        <a class="btn btn-dark" type="button" href="{route path="admin.php?dispatch=auth.logout_all_device&user_id=`$user.id`"}">{$lang.text_logout_all}</a>
    </div>

</div>