<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Bharat Art & Craft Admin Control Panel" />
    <meta name="author" content="Bharat Art & Craft" />
    <title>@yield('site_title', 'Dashboard') - Bharat Art & Craft Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous">

    <!-- Cropper.js CSS for Image Cropping in Popup (Local asset with fallback) -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/cropper.min.css') }}" />

    <!-- Core Template CSS & Modern Custom Admin CSS -->
    <link href="{{ asset('dashboard/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/css/custom-admin.css') }}?v={{ time() }}" rel="stylesheet" />
    @yield('extra_styles')
</head>

<body class="@yield('body_class', 'sb-nav-fixed')">
    @yield('inner_section')

    <!-- Global Image Crop Modal Popup (direct child of body) -->
    @include('admin.components.crop-modal')

    <!-- jQuery, Bootstrap 5 Bundle, SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Cropper.js for Image Cropping Popup (Local asset with fallback) -->
    <script src="{{ asset('dashboard/js/cropper.min.js') }}"></script>

    <!-- Core Scripts -->
    <script src="{{ asset('dashboard/js/scripts.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('dashboard/js/image-cropper.js') }}?v={{ time() }}"></script>

    <!-- TinyMCE Rich Text Editor -->
    <script src="https://cdn.tiny.cloud/1/{{ env('TINY_API_KEY') }}/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '.myEditor',
                branding: false,
                menubar: false,
                plugins: 'lists link code',
                toolbar: 'bold italic underline strikethrough | h1 h2 h3 | alignleft aligncenter alignright alignjustify | numlist bullist | link | code',
                skin: 'oxide',
                content_css: 'default'
            });
        }
    </script>

    @yield('extra_scripts')
</body>

</html>