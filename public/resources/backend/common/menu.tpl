{assign var="route" value=$smarty.request.dispatch}
{assign var="route_dropdown" value="."|explode:$route}

{$route_dropdown =  $route_dropdown[0]}
{assign var="menus" value=fn_get_menus()}

{block name="menu"}
  <!-- Menu -->
  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{route path="admin.php?dispatch=dashboard"}" class="app-brand-link">
        {include file="backend/common/logo.svg"}
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
    
      {foreach from=$menus item=menu key=key}
        {if $menu.child}
        <li class="menu-item {if $route_dropdown eq $key} open {/if}">
          <a href="{$menu.link}" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx {$menu.icon}"></i>
            <div data-i18n="{$menu.title}">{$menu.title}</div>                
          </a>
          <ul class="menu-sub">                
          {foreach from=$menu.child item=child key=k}            
            <li class="menu-item {if $route eq $k} active {/if}">
              <a href="{$child.link}" class="menu-link">
                <div data-i18n="{$child.title}">{$child.title}</div>
              </a>
            </li>
          {/foreach}
          </ul>
          </li>
        {else}
          <li class="menu-item {if $route_dropdown eq $key} active {/if}">
            <a href="{$menu.link}" class="menu-link">
              <i class="menu-icon tf-icons bx {$menu.icon}"></i>
              <div data-i18n="{$menu.title}">{$menu.title}</div>
            </a>
          </li>
        {/if}
      {/foreach}
    </ul>
  </aside>
  <!-- / Menu -->        
{/block}