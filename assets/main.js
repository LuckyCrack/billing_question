$(document).on('click','#add-item', function() {
    event.preventDefault();
    $.ajax({
        url: './controllers/crud.php',
        type: 'POST',
        data: $('#add_product_form').serialize(), 
        json: true,
        success: function(data) {
            if(data.success == true) {
                $('#add_product_form')[0].reset();
                $("#addItem").modal('hide');
                swal("Saved!", data.msg, "success");
                setTimeout(() => {
                    location.reload()
                }, 500);
            }
            else
            {
                if(data.success == false)
                {
                    swal("Error!", data.msg, "error");
                }
            }
        },
        error: function(data) {
            swal("Error!", data, "error");
        }
    });
});

$(document).on('click','#delete-item', function() {
    event.preventDefault();
    var id = $(this).attr('product_id');
    var csfr = $(this).attr('token');

    var data_delete = {
        product_id: id,
        csrf_token: csfr
    };

    $.ajax({
        url: './controllers/delete.php',
        type: 'POST',
        data: data_delete, 
        json: true,
        success: function(data) {
            if(data.success == true) {
                swal("Deleted!", data.msg, "success");
                setTimeout(() => {
                    location.reload()
                }, 500);
            }
            else
            {
                if(data.success == false)
                {
                    swal("Error!", data.msg, "error");
                }
            }
        },
        error: function(data) {
            swal("Error!", data, "error");
        }
    });
});

$(document).on('click','#add-field', function() {
    event.preventDefault();
    var list_item = '<li id="listItem" class="list-group-item"><div class="row"><div class="col-6"><input type="text" class="form-control" name="product_id[]" placeholder="Enter Product Id"></div><div class="col-6"><input type="text" class="form-control" name="product_quantity[]" placeholder="Enter Quantity"></div></div></li>'
    $("#inputList").append(list_item);
});


$(document).on('click','#generate-bill', function() {
    event.preventDefault();
    $.ajax({
        url: './commons/invoice.php',
        type: 'POST',
        data: $('#billing-form').serialize(), 
        success: function(data) {
            if(data.success == true) {
                $('#billing-form')[0].reset();
                swal("Saved!", data.msg, "success");
            }
            else
            {
                if(data.success == false)
                {
                    swal("Error!", data.msg, "error");
                }
            }
        },
        error: function(data) {
            swal("Error!", data, "error");
        }
    });
});