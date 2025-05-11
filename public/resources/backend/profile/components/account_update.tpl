<div class="card mb-4">
    <h5 class="card-header">{$lang.title}</h5>
    <!-- Account -->
    <form id="formAccountSettings" method="POST" action="{route path="admin.php?dispatch=profile.account"}"
        class="form-ajax">
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{if $user.profile}{$user.profile}{else}public/assets/filemanager/default.png{/if}" alt="user-avatar" class="d-block rounded f_image" height="100" width="100"
                    id="open-file-manager" />
                <input name="f_image" value="{if $user.profile}{$user.profile}{else}public/assets/filemanager/default.png{/if}" type="hidden">
            </div>
        </div>
        <hr class="my-0" />

        <div class="card-body">

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="elm_firstname" class="form-label">{$lang.text_firstname}</label>
                    <input type="hidden" name="user_id" value="{$authId}" class="form-control" />
                    <input class="form-control" type="text" id="elm_firstname" name="firstname"
                        value="{$user.firstname}" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="elm_lastname" class="form-label">{$lang.text_lastname}</label>
                    <input class="form-control" type="text" name="lastname" id="elm_lastname"
                        value="{$user.lastname}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="elm_email" class="form-label">{$lang.text_email}</label>
                    <input class="form-control" type="text" id="elm_email" name="email" value="{$user.email}"
                        placeholder="{$user.email}" />
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="elm_phone">{$lang.text_phone}</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="elm_phone" name="phone" class="form-control" value="{$user.phone}"
                            placeholder="{$user.phone}" />
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="elm_role">{$lang.text_group}</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" disabled value="{$user.role}"
                            placeholder="{$user.role}" />
                    </div>
                    <div class="">
                        <a
                            href="{route path="admin.php?dispatch=system.users.update&user_id=`$user.id`"}">{$lang.text_edit_role}</a>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="elm_status">Status</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" disabled value="{fn_get_status($user.active)}"
                            placeholder="{fn_get_status($user.active)}" />
                    </div>
                    <div class="">
                        <a
                            href="{route path="admin.php?dispatch=system.users.update&user_id=`$user.id`"}">{$lang.text_edit_status}</a>
                    </div>
                </div>

            </div>
            <div class="mt-2">
                <button type="submit" name="button" class="btn btn-primary me-2">{$lang.text_btn_save}</button>
            </div>
        </div>
    </form>
    <!-- /Account -->
</div>