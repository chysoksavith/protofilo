<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>chysoksavit</title>
</head>

<body class="index-page">
    <div class="loader">
        <div class="counter">0</div>
    </div>
    <!--  -->
    @include('body.header')
    <!--  -->
    @yield('content')

    @include('body.footer')

    <!-- Include GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <!-- Include ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <!-- Include IntersectionObserver Polyfill (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.12.2/intersection-observer.min.js"></script>
    <!-- Include Lenis (if using) -->
    <script src="https://cdn.jsdelivr.net/npm/lenis@1.0.0/dist/lenis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/circular-revealer@0.0.8/dist/index.iife.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/CSSRulePlugin.min.js"></script>

    @yield('script')
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/scroll.js') }}"></script>
    <script src="{{ asset('assets/js/textScrool.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                // Optional configuration options
                offset: 120, // Offset (in px) from the original trigger point
                delay: 0, // Delay (in ms) before animation starts
                duration: 1000, // Duration (in ms) of the animation
                easing: 'ease', // Easing function for the animation
                once: false, // Whether animation should happen only once
                mirror: false, // Whether animation should trigger when scrolling back
            });
        });
    </script>
</body>

</html>
