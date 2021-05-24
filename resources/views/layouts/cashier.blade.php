<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/theme_asset/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="/theme_asset/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="/theme_asset/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="/theme_asset/vendors/css/extensions/pace.css">
    <link rel="stylesheet" type="text/css" href="/theme_asset/vendors/css/ui/prism.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="/theme_asset/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/theme_asset/css/app.css">
    <link rel="stylesheet" type="text/css" href="/theme_asset/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/theme_asset/css/plugins/animate/animate.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/theme_asset/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/theme_asset/css/core/menu/menu-types/vertical-overlay-menu.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/theme_asset/css/style.css">
</head>


<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  fixed-navbar  pace-done">

    @include('cashier.parts.navigation')

    @yield('content')

    <script src="/theme_asset/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="/theme_asset/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="/theme_asset/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="/theme_asset/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="/theme_asset/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="/theme_asset/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="/theme_asset/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="/theme_asset/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="/theme_asset/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="/theme_asset/vendors/js/ui/prism.min.js" type="text/javascript"></script>
    <script src="/theme_asset/js/scripts/modal/components-modal.js" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="/theme_asset/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/theme_asset/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    @yield('javascript')
</body>
</html>

