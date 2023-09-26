<script>
    $(document).ready(function() {
        $('.single-select2').select2({
            theme: 'bootstrap-5',
            placeholder: $(this).data('placeholder'),
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            
        });

       
    });
</script>