{assign var="title" value="Customers lists"}

{include file="backend/layouts/header.tpl"}

{block name="backend_page"}
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {* {$menu} *}
            {block name="menu"}
                {include file="backend/common/menu.tpl"}
            {/block}
            <!-- Layout container -->
            <div class="layout-page">
                {block name="nav"}
                    {include file="backend/layouts/nav.tpl"}
                {/block}

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch}
                        <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-8"><h6 class="card-title">{{ __('Setting') }}<h6></div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" form="form-setting-form" data-toggle="tooltip" title="" data-original-title="Save" class="btn btn-primary ml-1"><i class="fa fa-save"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab">{{ __('General') }}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-store-tab" data-toggle="pill" href="#pills-store" role="tab">{{ __('Store')}}</a>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-account-tab" data-toggle="pill" href="#pills-account" role="tab">{{ __('Store Account')}}</a>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-option-tab" data-toggle="pill" href="#pills-option" role="tab">{{ __('Option')}}</a>
                            </li>                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-customer-tab" data-toggle="pill" href="#pills-customer" role="tab">{{ __('Customer Options')}}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-image-tab" data-toggle="pill" href="#pills-image" role="tab">{{ __('Image')}}</a>
                            </li>
                        </ul>
                        <form action="{{ route('admin.web.panel.setting.edit') }}" method="post" enctype="multipart/form-data" id="form-setting-form">
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    @csrf
                                    <div class="form-group ">
                                        <label for="input-url"><span data-toggle="tooltip" data-html="true" data-original-title="{{ __('global.info_url') }}">Store URL</span></label>
                                        <input type="text" name="config_site_url" value="@if(old('config_site_url')) {{ old('config_site_url') }} @else{{ config('settings.config_site_url') }}@endif" placeholder="Store URL" id="input-url" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="store_name">{{ __('Store Name') }} <span class="text-danger">*</span></label>  
                                        <input type="text" name="config_store_name" class="form-control" value="@if(old('config_store_name')){{ old('config_store_name') }}@else{{ config('settings.config_store_name') }}@endif" >
                                        @if(!empty($errors->first('config_store_name')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_store_name') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="store_name">{{ __('Loader Type') }} <span class="text-danger">*</span></label>  
                                        <select name="config_loder_type" id="loder_type">
                                            <option value="text" @if(old('config_loder_type') == 'text') selected @endif @if(config('settings.config_loder_type') == 'text') selected @endif> {{ __('Text') }} </option>
                                            <option value="default"  @if(old('config_loder_type') == 'default') selected @endif @if(config('settings.config_loder_type') == 'default') selected @endif> {{ __('Default') }} </option>                                            
                                        </select>
                                        @if(!empty($errors->first('config_loder_type')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_loder_type') }}</small>
                                        </div>
                                        @endif
                                        
                                    </div>    
                                    
                                    <div class="text-loader"></div>
                                    <div class="class-error">
                                        @if(!empty($errors->first('config_loder_name')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_loder_name') }}</small>
                                        </div>
                                        @endif
                                        @if(!empty($errors->first('config_loder_color')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_loder_color') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="store_name">{{ __('Pagination Per Page') }} <span class="text-danger">*</span></label>  
                                        <input type="text" name="config_pagination" class="form-control" value="@if(old('config_pagination')){{ old('config_pagination') }}@else{{ config('settings.config_pagination') }}@endif" >
                                        @if(!empty($errors->first('config_pagination')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_pagination') }}</small>
                                        </div>
                                        @endif
                                    </div>               
                                </div>
                                <div class="tab-pane fade" id="pills-store" role="tabpanel" aria-labelledby="pills-store-tab">
                                    
                                    <div class="form-group ">
                                        <label for="input-url">Store Address</label>
                                        <textarea name="config_store_address" placeholder="Store address" class="form-control" rows="5">@if(old('config_store_address')){{ old('config_store_address') }}@else{{ config('settings.config_store_address') }}@endif</textarea>
                                    </div>

                                    <div class="form-group ">
                                        <label for="input-url">Store Contact No.</label>
                                        <input type="text" name="config_store_contact" value="@if(old('config_store_contact')){{ old('config_store_contact') }}@else{{ config('settings.config_store_contact') }}@endif" placeholder="Store contact number" class="form-control">
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label for="input-url">Store Email</label>
                                        <input type="text" name="config_store_email" value="@if(old('config_store_email')){{ old('config_store_email') }}@else{{ config('settings.config_store_email') }}@endif" placeholder="Store email" class="form-control">
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label for="input-url">Website</label>
                                        <input type="text" name="config_store_website" value="@if(old('config_store_website')){{ old('config_store_website') }}@else{{ config('settings.config_store_website') }}@endif" placeholder="Store email" class="form-control">
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label for="input-url">Store Payment Note</label>
                                        <input type="text" name="config_store_payment_note" value="@if(old('config_store_payment_note')){{ old('config_store_payment_note') }}@else{{ config('settings.config_store_payment_note') }}@endif" placeholder="Store email" class="form-control">
                                    </div>
                                    
                                </div>
                                <div class="tab-pane fade" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab">
                                    
                                    <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="select_bank">Select Your Bank</label>
                                                <div id="the-basics">
                                                    <input class="typeahead form-control" autocomplete="off" name="config_bank_name" value="@if(old('config_bank_name')){{ old('config_bank_name') }}@else{{ config('settings.config_bank_name') }}@endif" type="text" placeholder="Type Bank Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Branch Name</label>
                                                    <input type="text" class="form-control" name="config_bank_branch"value="@if(old('config_bank_branch')){{ old('config_bank_branch') }}@else{{ config('settings.config_bank_branch') }}@endif" maxlength="50">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">A/C Name</label>
                                            <input type="text" class="form-control" name="config_bank_account_name" value="@if(old('config_bank_account_name')){{ old('config_bank_account_name') }}@else{{ config('settings.config_bank_account_name') }}@endif" maxlength="70">
                                            
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="name">A/C No.</label>
                                                <input type="text" class="form-control" name="config_bank_account_no" value="@if(old('config_bank_account_no')){{ old('config_bank_account_no') }}@else{{ config('settings.config_bank_account_no') }}@endif" maxlength="20">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="name">IFSC Code </label>
                                            <input type="text" class="form-control" name="config_bank_ifsc" value="@if(old('config_bank_ifsc')){{ old('config_bank_ifsc') }}@else{{ config('settings.config_bank_ifsc') }}@endif" maxlength="11">
                                            
                                        </div>
                                    
                                </div>
                                <div class="tab-pane fade" id="pills-option" role="tabpanel" aria-labelledby="pills-option-tab">
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Default Role') }}</label>
                                        <select name="config_default_group" id="config_default_group" class="form-control">
                                            <option selected>{{ __('---- select role ----') }}</option>
                                            @if(count($data['roles']) > 0)
                                            @foreach($data['roles'] as $role)
                                            
                                            <option value="{{ $role->id }}" @if(old('config_default_group') == $role->id) selected @endif @if(config('settings.config_default_group') == $role->id) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_default_group')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_default_group') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Which customer redirect dashboard?') }}</label>
                                        <select name="config_default_redirect" id="config_default_redirect" class="form-control">
                                            <option selected>{{ __('---- select role ----') }}</option>
                                            @if(count($data['roles']) > 0)
                                            @foreach($data['roles'] as $role)
                                            
                                            <option value="{{ $role->id }}" @if(old('config_default_redirect') == $role->id) selected @endif @if(config('settings.config_default_redirect') == $role->id) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_default_redirect')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_default_redirect') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="input-url">Mime Type</label>
                                        <input type="text" name="config_mime_type" value="@if(old('config_mime_type')){{ old('config_mime_type') }}@else{{ config('settings.config_mime_type') }}@endif" placeholder="Mime extension" class="form-control">
                                    </div>

                                    <div class="form-group ">
                                        <label for="input-url">Max Upload Size</label>
                                        <input type="text" name="config_max_upload_size" value="@if(old('config_max_upload_size')){{ old('config_max_upload_size') }}@else{{ config('settings.config_max_upload_size') }}@endif" placeholder="max upload size" class="form-control">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Profile Edit') }}</label>
                                        <select name="config_profile_edit" id="config_profile_edit" class="form-control">
                                            @if(!config('settings.config_profile_edit'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_profile_edit')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_profile_edit') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Password Edit') }}</label>
                                        <select name="config_password_edit" id="config_password_edit" class="form-control">
                                            @if(!config('settings.config_password_edit'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                            
                                        </select>
                                        @if(!empty($errors->first('config_password_edit')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_password_edit') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Two Way Auth') }}</label>
                                        <select name="config_two_way_authentication" id="config_two_way_authentication" class="form-control">
                                        @if(!config('settings.config_two_way_authentication'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_two_way_authentication')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_two_way_authentication') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Other Devices Login') }}</label>
                                        <select name="config_other_devices" id="config_other_devices" class="form-control">
                                        @if(!config('settings.config_other_devices'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_other_devices')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_other_devices') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Customer Ticket System')}}</label>
                                        <select name="config_ticket_support_panel" id="config_ticket_support_panel" class="form-control">
                                        @if(!config('settings.config_ticket_support_panel'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_ticket_support_panel')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_ticket_support_panel') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Account Create') }}</label>
                                        <select name="config_account_create" id="config_account_create" class="form-control">
                                        @if(!config('settings.config_account_create'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_account_create')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_account_create') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Password Forget') }}</label>
                                        <select name="config_password_forget" id="config_account_create" class="form-control">
                                        @if(!config('settings.config_password_forget'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_password_forget')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_password_forget') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Customer Login') }}</label>
                                        <select name="config_user_account_login" id="config_user_account_login" class="form-control">
                                        @if(!config('settings.config_user_account_login'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_user_account_login')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_user_account_login') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">
                                   
                                    </style>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                        </div>
                                        <div class="col-md-12">
                                            
                                        </div>
                                    </div>
                                </div>      

                            </div>
                        </form>
                    </div>
                </div>
            </div>
                        
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    {block name="footer_note"}
                        {include file="backend/layouts/footer_note.tpl"}
                      {/block}
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
{/block}

{include file="backend/layouts/footer.tpl"}