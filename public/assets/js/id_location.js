
// Event listener ketika province dipilih, mempengaruhi isian kota
$('#province').on('change', function() {
    var provinceCode = $(this).val();
    var citySelect = $('#city');

    citySelect.empty().append('<option value="" disabled>Select City</option>');
    
    // ambil data city dari AJAX request
    $.ajax({
        url: '/cities/' + provinceCode,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $.each(data, function(key, city) {
                citySelect.append('<option value="' + city.code + '">' + city.name + '</option>');
            });
        },
        error: function() {
            console.log('Error retrieving cities data.');
        }
    });
});

// Event listener ketika city dipilih, mempengaruhi isian district
$('#city').on('change', function() {
    var cityCode = $(this).val();
    var districtSelect = $('#district');

    districtSelect.empty().append('<option value="" disabled>Select District</option>')

    // ambil data district dari AJAX request
    $.ajax({
        url: '/districts/' + cityCode,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $.each(data, function(key, district) {
                districtSelect.append('<option value="' + district.code + '">' + district.name + '</option>')
            });
        },
        error: function() {
            console.log('Error retrieving districts data');
        }
     });
});

// Event listener ketika district dipilih, mempengaruhi isian village
$('#district').on('change', function() {
    var districtCode = $(this).val();
    var villageSelect = $('#village');

    villageSelect.empty().append('<option value="" disabled>Select Village</option>')

    // ambil data village dari AJAX request
    $.ajax({
        'url': '/villages/' + districtCode,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $.each(data, function(key, village) {
                villageSelect.append('<option value="' + village.code + '">' + village.name + '</option>')
            });
        },
        error: function() {
            console.log('Error retrieving village data');
        }
    });

});