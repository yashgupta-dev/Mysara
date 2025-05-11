
{capture assign='main_content'}

                    <div class="container-xxl flex-grow-1 container-p-y">
                        {* {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch} *}

                        <div class="card">
                            <div class="card-body">
                                <form class="form-ajax mb-3" action="{route path="admin.php?dispatch=catalog.group.add"}" method="POST">
                                    <div class="form-group mb-3">
                                        <label for="elm-group-name" class="form-label">{$lang.text_group_name}</label>
                                        <input type="text" class="form-control" id="elm-group-name" name="name"/>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="elm-group-sort" class="form-label">{$lang.text_group_sort}</label>
                                        <input type="text" class="form-control" id="elm-group-sort" name="sort"/>
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