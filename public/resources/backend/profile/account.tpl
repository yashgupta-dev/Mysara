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

            <div class="row">
              <div class="col-md-12">
                {include file="backend/profile/components/account_update.tpl"}
                
                {include file="backend/profile/components/browser_session.tpl"}

                {include file="backend/profile/components/account_delete.tpl"}

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