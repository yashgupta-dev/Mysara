<div class="card">
    <!-- Notifications -->
    <form id="formAccountSettings" method="POST" action="{route path="admin.php?dispatch=profile.setting"}"
    class="form-ajax">
        <div class="table-responsive">
            <table class="table table-striped table-borderless border-bottom">
                <thead>
                    <tr>
                        <th class="text-nowrap">{$lang.column_type}</th>
                        <th class="text-nowrap text-center">{$lang.column_notification}</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$notification item=item key=key}
                    <tr>
                        {$lang_key = 'text_'|cat:$key}
                        <td class="text-nowrap">{$lang.$lang_key}</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                                <input class="form-check-input" name="notification[{$key}]" type="hidden" id="{$key}" value="N">
                                <input class="form-check-input" name="notification[{$key}]" type="checkbox" id="{$key}" value="Y" {if $user.notification_get[$key] eq 'Y'} checked {/if}>
                            </div>
                        </td>

                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
        
        <div class="card-body">
            {* <h6>{$lang.text_notification_text}</h6> *}
            <div class="row">
                {* <div class="col-sm-6">
                    <select id="sendNotification" class="form-select" name="send_notification">
                        <option value="">{$lang.text_none}</option>
                        <option value="O" {if $user.receive_notification eq 'O'} selected {/if}>{$lang.text_notification_online}</option>
                        <option value="A" {if $user.receive_notification eq 'A'} selected {/if}>{$lang.text_anytime}</option>
                    </select>
                </div> *}
                <div class="mt-4">
                    <button type="submit" name="button" class="btn btn-primary me-2">{$lang.text_btn_save}</button>
                </div>
            </div>
        </div>
    </form>
    <!-- /Notifications -->
</div>