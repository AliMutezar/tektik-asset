<script src="{{ url('assets/js/bootstrap.js') }}"></script>
<script src="{{ url('assets/js/app.js') }}"></script>

<!-- Need: Apexcharts -->
<script src="{{ url("assets/extensions/apexcharts/apexcharts.min.js") }}"></script>
<script src="{{ url("assets/js/pages/dashboard.js") }}"></script>

{{-- Choices --}}
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

{{-- Sweetalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- File uploader --}}
<script src="{{ url('assets/extensions/filepond/filepond.js') }} "></script>
<script src="{{ url('assets/extensions/toastify-js/src/toastify.js') }} "></script>
<script src="{{ url('assets/js/pages/filepond.js') }} "></script>

{{-- Data Tables --}}
<script src="{{ url('assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>

{{-- Numeral JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

{{-- sketchpad --}}
<script src="{{ url('assets/js/sketchpad.js') }}"></script>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ url('assets/js/jquery.signature.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#data-table').DataTable({
            scrollX: true,
        });
    });
</script>