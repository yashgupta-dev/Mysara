
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
                
                {$main_content|default:''}

    
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
    