<script>
    function getCities(province) {
        const code = province.value;
        $.ajax({
            type: 'GET',
            url: '/cities/' + code,
            data: {
                province_code: code
            },
            success: function(response) {
                $('#city').empty();

                for (i = 0; i < response.length; i++) {
                    $('#city').append('<option value="' + response[i].code + '">' + response[i].name +
                        '</option>');
                }

                $('#city').trigger('change');
            }
        });
    }

    function getDistrict(city) {
        const cityCode = city.value;
        $.ajax({
            type: 'GET',
            url: '/districts/' + cityCode,
            data: {
                city_code: cityCode
            },
            success: function(response) {

                $('#district').empty();

                for (i = 0; i < response.length; i++) {
                    $('#district').append('<option value="' + response[i].code + '">' + response[i].name +
                        '</option>');
                }

                $('#district').trigger('change');
            }

        });
    }

    function getVillage(district) {
        const districtCode = district.value;
        $.ajax({
            type: 'GET',
            url: '/villages/' + districtCode,
            data: {
                district_code: districtCode
            },
            success: function(response) {

                $('#village').empty();

                for (i = 0; i < response.length; i++) {
                    $('#village').append('<option value="' + response[i].code + '">' + response[i].name +
                        '</option>');
                }

                $('#village').trigger('change');
            }
        });
    }
</script>