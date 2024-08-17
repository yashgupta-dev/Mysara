{assign var="title" value=$lang.text_heading}

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
                        <div class="col-md-12 grid-margin stretch-card">

                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="javascript:void(0);">{$lang.text_general}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">{$lang.text_store}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">{$lang.text_option}</a>
                                        </li>
                                    </ul>
                                    <div class="card mb-4">
                                        <!-- Account -->
                                        <div class="card-body">
                                            <form id="formAccountSettings" method="POST" >
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="firstName" class="form-label">First Name</label>
                                                        <input class="form-control" type="text" id="firstName"
                                                            name="firstName" value="John" autofocus />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="lastName" class="form-label">Last Name</label>
                                                        <input class="form-control" type="text" name="lastName"
                                                            id="lastName" value="Doe" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="email" class="form-label">E-mail</label>
                                                        <input class="form-control" type="text" id="email" name="email"
                                                            value="john.doe@example.com"
                                                            placeholder="john.doe@example.com" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="organization" class="form-label">Organization</label>
                                                        <input type="text" class="form-control" id="organization"
                                                            name="organization" value="ThemeSelection" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text">US (+1)</span>
                                                            <input type="text" id="phoneNumber" name="phoneNumber"
                                                                class="form-control" placeholder="202 555 0111" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address"
                                                            placeholder="Address" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="state" class="form-label">State</label>
                                                        <input class="form-control" type="text" id="state" name="state"
                                                            placeholder="California" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="zipCode" class="form-label">Zip Code</label>
                                                        <input type="text" class="form-control" id="zipCode" name="zipCode"
                                                            placeholder="231465" maxlength="6" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="language" class="form-label">Language</label>
                                                        <select id="language" class="select2 form-select">
                                                            <option value="">Select Language</option>
                                                            <option value="en">English</option>
                                                            <option value="fr">French</option>
                                                            <option value="de">German</option>
                                                            <option value="pt">Portuguese</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary me-2">{$lang.text_btn_save}</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /Account -->
                                    </div>

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