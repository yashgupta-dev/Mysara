
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
                    

                            <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">{{ tab_general }}</a></li>
            <li><a href="#tab-data" data-toggle="tab">{{ tab_data }}</a></li>
            <li><a href="#tab-seo" data-toggle="tab">{{ tab_seo }}</a></li>
            <li><a href="#tab-design" data-toggle="tab">{{ tab_design }}</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                {% for language in languages %}
                <li><a href="#language{{ language.language_id }}" data-toggle="tab"><img src="language/{{ language.code }}/{{ language.code }}.png" title="{{ language.name }}" /> {{ language.name }}</a></li>
                {% endfor %}
              </ul>
              <div class="tab-content">
                {% for language in languages %}
                <div class="tab-pane" id="language{{ language.language_id }}">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name{{ language.language_id }}">{{ entry_name }}</label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[{{ language.language_id }}][name]" value="{{ category_description[language.language_id] ? category_description[language.language_id].name }}" placeholder="{{ entry_name }}" id="input-name{{ language.language_id }}" class="form-control" />
                      {% if error_name[language.language_id] %}
                      <div class="text-danger">{{ error_name[language.language_id] }}</div>
                      {% endif %}
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description{{ language.language_id }}">{{ entry_description }}</label>
                    <div class="col-sm-10">
                      <textarea name="category_description[{{ language.language_id }}][description]" placeholder="{{ entry_description }}" id="input-description{{ language.language_id }}" data-toggle="summernote" data-lang="{{ language.locale }}" class="form-control">{{ category_description[language.language_id] ? category_description[language.language_id].description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title{{ language.language_id }}">{{ entry_meta_title }}</label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[{{ language.language_id }}][meta_title]" value="{{ category_description[language.language_id] ? category_description[language.language_id].meta_title }}" placeholder="{{ entry_meta_title }}" id="input-meta-title{{ language.language_id }}" class="form-control" />
                      {% if error_meta_title[language.language_id] %}
                      <div class="text-danger">{{ error_meta_title[language.language_id] }}</div>
                      {% endif %}
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description{{ language.language_id }}">{{ entry_meta_description }}</label>
                    <div class="col-sm-10">
                      <textarea name="category_description[{{ language.language_id }}][meta_description]" rows="5" placeholder="{{ entry_meta_description }}" id="input-meta-description{{ language.language_id }}" class="form-control">{{ category_description[language.language_id] ? category_description[language.language_id].meta_description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword{{ language.language_id }}">{{ entry_meta_keyword }}</label>
                    <div class="col-sm-10">
                      <textarea name="category_description[{{ language.language_id }}][meta_keyword]" rows="5" placeholder="{{ entry_meta_keyword }}" id="input-meta-keyword{{ language.language_id }}" class="form-control">{{ category_description[language.language_id] ? category_description[language.language_id].meta_keyword }}</textarea>
                    </div>
                  </div>
                </div>
                {% endfor %}
              </div>
            </div>
            <div class="tab-pane" id="tab-data">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent">{{ entry_parent }}</label>
                <div class="col-sm-10">
                  <input type="text" name="path" value="{{ path }}" placeholder="{{ entry_parent }}" id="input-parent" class="form-control" />
                  <input type="hidden" name="parent_id" value="{{ parent_id }}" />
                  {% if error_parent %}
                  <div class="text-danger">{{ error_parent }}</div>
                  {% endif %}
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-filter"><span data-toggle="tooltip" title="{{ help_filter }}">{{ entry_filter }}</span></label>
                <div class="col-sm-10">
                  <input type="text" name="filter" value="" placeholder="{{ entry_filter }}" id="input-filter" class="form-control" />
                  <div id="category-filter" class="well well-sm" style="height: 150px; overflow: auto;">
                    {% for category_filter in category_filters %}
                    <div id="category-filter{{ category_filter.filter_id }}"><i class="fa fa-minus-circle"></i> {{ category_filter.name }}
                      <input type="hidden" name="category_filter[]" value="{{ category_filter.filter_id }}" />
                    </div>
                    {% endfor %}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{ entry_store }}</label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    {% for store in stores %}
                    <div class="checkbox">
                      <label>
                        {% if store.store_id in category_store %}
                        <input type="checkbox" name="category_store[]" value="{{ store.store_id }}" checked="checked" />
                        {{ store.name }}
                        {% else %}
                        <input type="checkbox" name="category_store[]" value="{{ store.store_id }}" />
                        {{ store.name }}
                        {% endif %}
                      </label>
                    </div>
                    {% endfor %}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{ entry_image }}</label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="{{ thumb }}" alt="" title="" data-placeholder="{{ placeholder }}" /></a>
                  <input type="hidden" name="image" value="{{ image }}" id="input-image" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="{{ help_top }}">{{ entry_top }}</span></label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      {% if top %}
                      <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                      {% else %}
                      <input type="checkbox" name="top" value="1" id="input-top" />
                      {% endif %}
                      &nbsp; </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-column"><span data-toggle="tooltip" title="{{ help_column }}">{{ entry_column }}</span></label>
                <div class="col-sm-10">
                  <input type="text" name="column" value="{{ column }}" placeholder="{{ entry_column }}" id="input-column" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">{{ entry_sort_order }}</label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="{{ sort_order }}" placeholder="{{ entry_sort_order }}" id="input-sort-order" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">{{ entry_status }}</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    {% if status %}
                    <option value="1" selected="selected">{{ text_enabled }}</option>
                    <option value="0">{{ text_disabled }}</option>
                    {% else %}
                    <option value="1">{{ text_enabled }}</option>
                    <option value="0" selected="selected">{{ text_disabled }}</option>
                    {% endif %}
                  </select> 
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-seo">
              <div class="alert alert-info"><i class="fa fa-info-circle"></i> {{ text_keyword }}</div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">{{ entry_store }}</td>
                      <td class="text-left">{{ entry_keyword }}</td>
                    </tr>
                  </thead>
                  <tbody>
                  {% for store in stores %}
                  <tr>
                    <td class="text-left">{{ store.name }}</td>
                    <td class="text-left">{% for language in languages %}
                      <div class="input-group"><span class="input-group-addon"><img src="language/{{ language.code }}/{{ language.code }}.png" title="{{ language.name }}" /></span>
                        <input type="text" name="category_seo_url[{{ store.store_id }}][{{ language.language_id }}]" value="{% if category_seo_url[store.store_id][language.language_id] %}{{ category_seo_url[store.store_id][language.language_id] }}{% endif %}" placeholder="{{ entry_keyword }}" class="form-control" />
                      </div>
                      {% if error_keyword[store.store_id][language.language_id] %}
                      <div class="text-danger">{{ error_keyword[store.store_id][language.language_id] }}</div>
                      {% endif %}
                      {% endfor %}</td>
                  </tr>
                  {% endfor %}
                  </tbody>
                  
                </table>
              </div>
            </div>            
            <div class="tab-pane" id="tab-design">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">{{ entry_store }}</td>
                      <td class="text-left">{{ entry_layout }}</td>
                    </tr>
                  </thead>
                  <tbody>

                   
                   
                  </tbody>
                </table>
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
    