$(function(event){
    /**
     * Get product list based on selected client list
     */
    $("#client_id").on('change',function(event){
       var client_id = $(this).val();
        $("#product_id").find('option')
            .remove()
            .end()
            .append('<option value="">Please select product</option>')
            .val('');
        if (client_id != ""){
            $.ajax({
                url: 'get/product/' + client_id,
                data: {},
                dataType: 'JSON',
                type: "GET",
                contentType: false,
                processData: false,
                success: function (response) {
                    $.each(response.data.products, function (key, value) {
                        $('#product_id')
                            .append($("<option></option>")
                                .attr("value", value.product_id)
                                .text(value.product_id));
                    });
                }
            });
        }
    })
});