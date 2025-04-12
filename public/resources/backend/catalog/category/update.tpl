
    {assign var="title" value=$lang.heading_title}

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
                    

                            <form action="{route path="admin.php?dispatch=catalog.category.add"}" method="post" enctype="multipart/form-data" id="form-category form-ajax" class="form-horizontal">
                              <ul class="nav nav-tabs">
                                  <li class="nav-item"><a href="#tab-general" data-bs-toggle="tab" class="nav-link active">{$lang.tab_general}</a></li>
                                  <li class="nav-item"><a href="#tab-data" data-bs-toggle="tab" class="nav-link">{$lang.tab_data}</a></li>
                                  <li class="nav-item"><a href="#tab-seo" data-bs-toggle="tab" class="nav-link">{$lang.tab_seo}</a></li>
                              </ul>
                              <div class="tab-content">
                                  <div class="tab-pane fade show active" id="tab-general">
                                    
                                    <input type="hidden" name="category_description[category_id]" value="{$category_id}" />
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
                                        <textarea name="category_description[description]" placeholder="{$lang.entry_description}" id="input-description" class="form-control">{if !empty($category_description.description)}{$category_description.description}{/if}</textarea>
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
                                          
                                  </div>
                              </div>
                          </form>

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
    