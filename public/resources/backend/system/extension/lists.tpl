{capture assign='main_content'}
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {* {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch} *}
                        <!-- Responsive Table -->
                        <div class="card">
                            {if !empty($extensions)}
                                <div class="card-body">
                                    <div class="row">
                                        <!-- User List Style -->
                                        <div class="col-12 col-lg-4 mb-4 mb-xl-0">
                                            <div class="demo-inline-spacing mt-3">
                                                <div class="list-group" id="modules">
                                                    {foreach from=$extensions item=item key=key}
                                                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer"
                                                            data-code="{$item.code}" data-url="{$item.view}">
                                                            <div class="avatar avatar-md me-3">
                                                                <span class="avatar-initial rounded-circle bg-label-primary"
                                                                    style="margin: 5px 0px 3px 0px;">{$item.icon}</span>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1">{$item.name}</h6>
                                                                        <small>{$item.count}</small>
                                                                        <div class="user-status">
                                                                            {* <span class="badge badge-dot bg-success"></span> *}
                                                                            {* <small>{'1/20 installed'}</small> *}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {/foreach}
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ User List Style -->
                                        <!-- Progress Style -->
                                        <div class="col-12 col-lg-8">
                                            <div class="demo-inline-spacing mt-3" id="modules-list">
                                                <div class="list-group text-center"><h3>{$lang.text_extensions_list}</h3></div>
                                            </div>
                                        </div>
                                        <!--/ Progress Style -->
                                    </div>
                                </div>
                            {/if}
                        </div>
                        <!--/ Responsive Table -->
                    </div>
                {/capture}
                {include file="backend/layouts/layout.tpl"}
                    