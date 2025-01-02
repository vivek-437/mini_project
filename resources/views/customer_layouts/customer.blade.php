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
        .custom-menu-active{
            color: var(--primary) !important;
        }
        .custom-color-white{
            color: var(--title) !important;
        }
    </style>
    @include('customer_layouts.customer-head-css')
    <!-- Page CSS -->
    @yield('css')


</head>

<body>
    <!-- Layout wrapper -->
    <div class="page-wraper" id="scroll-container">
        {{-- loader start --}}
        {{-- <div id="loading-area" class="preloader-wrapper-1">
            <div>
                <span class="loader-2"></span>
                <img src="images/logo.png" alt="/">
                <span class="loader"></span>
            </div>
        </div> --}}
        {{-- loader end --}}

        {{-- header start --}}
        @include('customer_layouts.customer-navbar')
        {{-- header end --}}
        <div class="page-content bg-white">
            @yield('content')
        </div>

        <button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>
        @include('customer_layouts.customer-footer')

    </div>

    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('customer_layouts.customer-vendor-script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            //code to fetch menu for navbar 
            $.ajax({
                url: "{{ route('customer.navbar') }}", // Replace with your actual route
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        const submenu = $('#dynamic-sub-menu');
                        submenu.empty(); // Clear existing submenu items

                        // Populate submenu with response data
                        response.data.forEach(item => {
                            submenu.append(
                                `<li><a href="javascript:void(0);" data-id="${item.id}">${item.name}</a></li>`
                                );
                        });

                    } else {
                        toastr.error('Failed to load submenu items. Please try again.');
                    }
                },
                error: function(xhr) {
                    toastr.error('Failed to fetch client details. Please try again later.');
                }
            });


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
