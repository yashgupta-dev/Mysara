
{capture assign='main_content'}

          <div class="container-xxl flex-grow-1 container-p-y">
            {* {include file="backend/common/breadcrumb.tpl" route=$smarty.request.dispatch} *}

            <div class="row">
              <div class="col-md-12">
                {include file="backend/profile/components/account_update.tpl"}
                
                {include file="backend/profile/components/browser_session.tpl"}

                {include file="backend/profile/components/account_delete.tpl"}

              </div>

            </div>
          </div>

        {/capture}
        {include file="backend/layouts/layout.tpl"}