<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{asset path='public/resources/backend/assets/'}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{$title}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{asset path='public/resources/backend/assets/img/favicon/favicon.ico'}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{asset path='public/resources/backend/assets/vendor/fonts/boxicons.css'}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{asset path='public/resources/backend/assets/vendor/css/core.css'}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{asset path='public/resources/backend/assets/vendor/css/theme-default.css'}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{asset path='public/resources/backend/assets/css/demo.css'}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{asset path='public/resources/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'}" />
    <link rel="stylesheet" href="{asset path='public/resources/backend/assets/vendor/libs/apex-charts/apex-charts.css'}" />

    <!-- Page CSS -->
    {block name="style"}{/block}

    <!-- Helpers -->
    <script src="{asset path='public/resources/backend/assets/vendor/js/helpers.js'}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{asset path='public/resources/backend/assets/js/config.js'}"></script>
</head>

<body>