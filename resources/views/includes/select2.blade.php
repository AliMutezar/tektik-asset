<script>
    $(document).ready(function() {
        $('#province, #city, #district, #village').select2({
            theme: 'bootstrap-5',
            placeholder: $(this).data('placeholder'),
        });
    });
</script>