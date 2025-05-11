<ul class="navbar-nav flex-row align-items-center ms-auto pb-2">
    <li class="nav-item">
<button type="button" data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-{if !empty($color)}{$color}{else}dark{/if} btn-md">
            <i class="bx bx-filter-alt"></i>{'Filter'}
        </button>
    </li>
</ul>

<div class="modal rightModal fade " id="filter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterTitle">{$title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {include file=$content}
                </div>
                <div class="modal-footer">                
                    <button type="submit" class="btn btn-sm btn-secondary">{'Save changes'}</button>
                </div>
            </form>
            
        </div>
    </div>
</div>