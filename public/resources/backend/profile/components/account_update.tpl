<div class="card mb-4">
    <h5 class="card-header">{$lang.title}</h5>
    <!-- Account -->
    <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="{asset path='public/resources/backend/assets/img/avatars/1.png'}" alt="user-avatar"
                class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">{$lang.text_upload_photo}</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" id="upload" class="account-file-input" hidden />
                </label>
                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">{$lang.text_reset}</span>
                </button>
            </div>
        </div>
    </div>
    <hr class="my-0" />

    <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{route path="admin.php?dispatch=profile.account"}"
            class="form-ajax">
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
                        <input type="text" class="form-control" disabled value="{$func->fn_get_status($user.active)}"
                            placeholder="{$func->fn_get_status($user.active)}" />
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
        </form>
    </div>
    <!-- /Account -->
</div>