<script>
    $(document).ready(function() {
        $('.single-select2').select2({
            theme: 'bootstrap-5',
            placeholder: $(this).data('placeholder'),
            
        });

        $('.single-select2').css('width', "100%");
    });
</script>