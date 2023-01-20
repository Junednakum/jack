$(function (event) {
    /**
    * Filter invoices
    */
    $("#invoice-filter-form").on('submit', function (event) {
        event.preventDefault();
        var form = this; 
        var formData = new FormData(form);
        $.ajax({
            url: 'filter/invoices',
            data: formData,
            dataType: 'JSON',
            type: "POST",
            contentType: false,
            processData: false,
            success: function (response) {
                //first empty table then append filtered result
                $("#table-container").empty();
                $("#table-container").html(response.data.invoiceList);
            }
        });
    })
});