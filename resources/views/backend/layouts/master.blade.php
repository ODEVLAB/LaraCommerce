@include('backend.layouts.head')

@include('backend.layouts.navbar')

@include('backend.layouts.sidebar')

@yield('content')


@include('backend.layouts.footer')
</div>
</div>




{{--<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/js/atlantis.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/summernote/summernote-bs4.js') }}"></script>

@yield('scripts')
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
        });
    });
</script>
<script type="text/javascript">
    if (jQuery().summernote) {
        $(".summernote").summernote({
            dialogsInBody: true,
            minHeight: 250
        });
        $(".summernote-simple").summernote({
            dialogsInBody: true,
            minHeight: 150,
            toolbar: [
                ["style", ["bold", "italic", "underline", "clear"]],
                ["font", ["strikethrough"]],
                ["para", ["paragraph"]]
            ]
        });
    }
</script>

</body>
</html>

