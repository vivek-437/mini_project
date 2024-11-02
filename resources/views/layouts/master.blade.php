<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ URL::asset('build/assets') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> @yield('title') | Shopping Website</title>


    <meta name="description" content="" />

    <!-- Favicon -->
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
        }
    </style>
    @include('layouts.master-head-css')
    <!-- Page CSS -->


</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('layouts.master-menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('layouts.master-navbar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    @yield('content')
                    <div class="toast-container"></div>

                    <!-- / Content -->

                    <!-- Footer -->
                    @include('layouts.master-footer')
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



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('layouts.master-vendor-script')
    <script>
        $(document).ready(function() {
            // Function to display a toast
            function showToast(message, type) {
                const toastHtml = `
            <div class="bs-toast toast fade show bg-${type}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">${type.charAt(0).toUpperCase() + type.slice(1)}</div>
                    <small>${new Date().toLocaleTimeString()}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>`;
                $('.toast-container').append(toastHtml);
                const toastEl = document.querySelector('.bs-toast:last-child');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                setTimeout(() => {
                    toast.hide();
                }, 3000);
            }

            // Display success toast
            @if (session('success'))
                showToast("{{ session('success') }}", "success");
            @endif

            // Display error toast
            @if (session('error'))
                showToast("{{ session('error') }}", "danger");
            @endif
        });
    </script>
    @yield('script')
</body>

</html>
