<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <title>@yield('title', ' Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Herozi is the top-selling Bootstrap 5 admin dashboard template. With Dark Mode, multi-demo options, RTL support, and lifetime updates, it's perfect for web developers.">
    <meta name="keywords"
        content="Herozi bootstrap dashboard, bootstrap, bootstrap 5, html dashboard, web dashboard, admin themes, web design, figma, web development, fullcalendar, datatables, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dark mode, bootstrap button, frontend dashboard, responsive bootstrap theme">
    <meta content="SRBThemes" name="author">
    <link rel="shortcut icon" href="{{ asset('assets/images/Favicon.png') }}">

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Herozi - The World's Best Selling Bootstrap Admin Template by SRBThemes">
    <meta property="og:description"
        content="Herozi is the top-selling Bootstrap 5 admin dashboard template. With Dark Mode, multi-demo options, RTL support, and lifetime updates, it's perfect for web developers.">
    <meta property="og:url" content="https://themeforest.net/user/srbthemes/portfolio">
    <meta property="og:site_name" content="Herozi by SRBThemes">

    @yield('css')
    @include('partials.head-css')
</head>

<body>
    @include('partials.header')
    @include('partials.sidebar')
    @include('partials.preloader')


    <main class="app-wrapper">
        <div class="app-container">
            @include('partials.breadcrumb')

            <!-- end page title -->

            @yield('content')

            @include('partials.bottom-wrapper')

            @yield('js')

</body>

</html>
