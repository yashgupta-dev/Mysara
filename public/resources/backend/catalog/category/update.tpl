{capture assign='main_content'}
<div class="container-xxl flex-grow-1 container-p-y">
    {* {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch} *}
    
    <div class="card">
    <div class="card-body">
    <form action="{route path="admin.php?dispatch=`$smarty.request.dispatch`"}" method="post" enctype="multipart/form-data" id="form-category" class="form-ajax form-horizontal">
        <input type="hidden" name="category_id" value="{if !empty($category_id)}{$category_id}{else}0{/if}" />
        <ul class="nav nav-tabs">
            <li class="nav-item"><a href="#tab-general" data-bs-toggle="tab" class="nav-link active">{$lang.tab_general}</a></li>
            <li class="nav-item"><a href="#tab-data" data-bs-toggle="tab" class="nav-link">{$lang.tab_data}</a></li>
            <li class="nav-item"><a href="#tab-seo" data-bs-toggle="tab" class="nav-link">{$lang.tab_seo}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-general">
            
                <div class="form-group mb-3">
                    <label class="form-label" for="input-name">{$lang.entry_name}</label>
                    <div class="col-sm-10">
                        <input type="text" name="category_description[name]" value="{if !empty($category_description.name)}{$category_description.name}{/if}" placeholder="{$lang.entry_name}" id="input-name" class="form-control" />
                        {if !empty($error_name)}
                        <div class="text-danger">{$error_name}</div>
                        {/if}
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="input-description">{$lang.entry_description}</label>
                    <div class="col-sm-10">
                    <textarea editor="ck-editor" name="category_description[description]" placeholder="{$lang.entry_description}" id="input-description" class="form-control">{if !empty($category_description.description)}{$category_description.description}{/if}</textarea>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="input-meta-title">{$lang.entry_meta_title}</label>
                    <div class="col-sm-10">
                    <input type="text" name="category_description[meta_title]" value="{if !empty($category_description.meta_title)}{$category_description.meta_title}{/if}" placeholder="{$lang.entry_meta_title}" id="input-meta-title" class="form-control" />
                        {if !empty($error_meta_title)}
                        <div class="text-danger">{$error_meta_title}</div>
                        {/if}
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="input-meta-title">{$lang.entry_description}</label>
                    <div class="col-sm-10">
                    <input type="text" name="category_description[meta_description]" value="{if !empty($category_description.meta_description)}{$category_description.meta_description}{/if}" placeholder="{$lang.entry_meta_description}" id="input-meta-title" class="form-control" />
                        {if !empty($error_meta_description)}
                        <div class="text-danger">{$error_meta_description}</div>
                        {/if}
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="input-meta-keyword">{$lang.entry_meta_keyword}</label>
                    <div class="col-sm-10">
                    <input type="text" name="category_description[meta_keyword]" value="{if !empty($category_description.meta_keyword)}{$category_description.meta_keyword}{/if}" placeholder="{$lang.entry_meta_keyword}" id="input-meta-keyword" class="form-control" />
                        {if !empty($error_meta_keyword)}
                        <div class="text-danger">{$error_meta_keyword}</div>
                        {/if}
                    </div>
                </div>
                    
            </div>
            <div class="tab-pane fade" id="tab-data">
                <div class="form-group mb-3">
                    <label class="col-sm-2 control-label" for="input-parent">{$lang.entry_parent}</label>
                    <div class="col-sm-10">
                        <input type="text" 
                            autocomplete="dropdown" 
                            name="path" 
                            value="{if !empty($category_description.path)}{$category_description.path}{/if}"
                            placeholder="{$lang.entry_parent}" 
                            id="input-parent"
                            class="form-control"
                            data-table="category_description"
                            data-select_columns="category_id, name"
                            data-search_column="name"
                            data-target="parent_id" />
                        <input type="hidden" name="parent_id" id="parent_id" value="{if !empty($category_description.path_id)}{$category_description.path_id}{/if}" />
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="col-sm-2 control-label" for="input-sort-order">{$lang.text_image}</label>
                    <div class="col-sm-10">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{if !empty($category_description.image)}{$category_description.image}{else}public/assets/filemanager/default.png{/if}" alt="user-avatar" class="d-block rounded f_image" height="100" width="100"
                                id="open-file-manager" />
                            <input name="f_image" value="{if !empty($category_description.image)}{$category_description.image}{else}public/assets/filemanager/default.png{/if}" type="hidden">
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-3">
                    <label class="col-sm-2 control-label" for="input-column">{$lang.entry_column}</label>
                    <div class="col-sm-10">
                        <input type="text" name="column" value="{if !empty($category_description.column)}{$category_description.column}{/if}" placeholder="{$lang.entry_column}" id="input-column" class="form-control" />
                    </div>
                </div>
                
                <div class="form-group mb-3">
                    <label class="col-sm-2 control-label" for="input-sort-order">{$lang.entry_sort_order}</label>
                    <div class="col-sm-10">
                        <input type="text" name="sort_order" value="{if !empty($category_description.sort_order)}{$category_description.sort_order}{/if}" placeholder="{$lang.entry_sort_order}" id="input-sort-order" class="form-control" />
                    </div>
                </div>
                
                <div class="form-group mb-3">
                    <label class="col-sm-2 control-label" for="input-status">{$lang.entry_status}</label>
                    <div class="col-sm-10">
                        <select name="status" id="input-status" class="form-control">
                            {if $category_description.status eq 'A'}
                                <option value="A" selected="selected">{$lang.text_enabled}</option>
                                <option value="D">{$lang.text_disabled}</option>
                            {else}
                                <option value="A">{$lang.text_enabled}</option>
                                <option value="D" selected="selected">{$lang.text_disabled}</option>
                            {/if}
                        </select>
                    </div>
                </div>
        
            </div>
            <div class="tab-pane fade" id="tab-seo">
                <div class="form-group mb-3">
                    <label class="form-label" for="input-meta-title">{$lang.entry_seo_url}</label>
                    <div class="col-sm-10">
                    <input type="text" name="seo_url" value="{if !empty($seo_url)}{$seo_url}{/if}" placeholder="{$lang.entry_seo_url}" id="input-meta-title" class="form-control" />
                        {if !empty($error_seo_url)}
                        <div class="text-danger">{$error_seo_url}</div>
                        {/if}
                    </div>
                </div>

            </div>
            </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit" name="button">{$lang.text_btn_save}</button>
        </div>
    </form>
    </div>
    </div>

</div>
{/capture}
{include file="backend/layouts/layout.tpl"}
                        