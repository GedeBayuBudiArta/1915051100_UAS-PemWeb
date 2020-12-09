$(document).ready(function(){
    $("#tombol-cari").click(function(){    
        $.ajax({
            url: 'http://localhost/ummi_/ajax/search.php',
            data: {
                keyword: $('#cari-value').val(),
            },
            type: 'POST',
            success: function(res) {
                $('.container').html(res);
            },
            error: function(error) {
                console.log(error);
            }
        })
    });
});