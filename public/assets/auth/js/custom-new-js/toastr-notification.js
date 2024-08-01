@if (Session::has('success'))


            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "duration": 3000,
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('danger'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('danger'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true

                    ,

            }
            toastr.warning("{{ session('danger') }}");
        @endif