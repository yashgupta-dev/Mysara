{capture assign='main_content'}

                    <div class="container-xxl flex-grow-1 container-p-y">
                        {* {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch} *}
                        
                        <!-- Responsive Table -->
                        <div class="card">
                            <div class="card-body">

                            <form class="form-ajax mb-3" action="{route path='admin.php?dispatch=extension.modules.gdpr.save'}" method="POST"
                                enctype="multipart/form-data">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="input-status">{$lang.text_status}</label>
                                    <select class="form-control" id="status" name="modules_gdpr_status">
                                        <option value="D" {if !empty($setting) && $setting.modules_gdpr_status == 'D'} selected {/if}>{$lang.text_disabled}</option>
                                        <option value="A" {if !empty($setting) && $setting.modules_gdpr_status == 'A'} selected {/if}>{$lang.text_enabled}</option>
                                    </select>                                    

                                </div>

                               
                                <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" name="button">{'Save changes'}</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        <!--/ Responsive Table -->
                    </div>
{/capture}
{include file="backend/layouts/layout.tpl"}