<script>
    $(document).ready(function() {
        $('#countries').DataTable();
        $(".dataTables_wrapper").css("width", "100%");
    });
    @if(Session::has('success'))
    toastr.options = {
        "closeButton": true
        , "progressBar": true
    }
    toastr.success("{{ session('success') }}");
    @elseif(Session::has('danger'))
    toastr.options = {
        "closeButton": true
        , "progressBar": true
    }
    toastr.warning("{{ session('danger') }}");
    @endif

</script>
