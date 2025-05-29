<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.css')
</head>

<body class="index-page">

    @include('user.header')
    <main class="main">
        @yield('main')
        <!-- Hero Section -->

        <!-- /Hero Section -->

        <!-- About Section -->

        <!-- Features Section -->
        <!-- /Features Section -->

        <!-- Stats Section -->
        <!-- /Stats Section -->

        <!-- Details Section -->
        <!-- /Details Section -->

        <!-- Gallery Section -->
        <!-- /Gallery Section -->

        <!-- Testimonials Section -->
        <!-- /Testimonials Section -->

        <!-- Team Section -->
        <!-- /Team Section -->

        <!-- Pricing Section -->
        <!-- /Pricing Section -->

        <!-- Faq Section -->
        <!-- /Faq Section -->

        <!-- Contact Section -->
        <!-- /Contact Section -->

    </main>

    @include('user.footer')
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
    @include('user.js')
</body>

</html>
