$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {


    // CATEGORY
    // Edit category
    $('.edit').click(function(){
        $('.error').hide();
        let id = $(this).data('id');
        $.ajax({
            type: "get",
            url: "admin/category/"+id+"/edit",
            dataType: "json",
            success: function ($result) {
                $('.name').val($result.name);
                $('.title').text($result.name);
                if($result.status == 1){
                    $('.ht').attr('selected','selected');
                }
                else{
                    $('.kht').attr('selected','selected');
                }
            }
        });
        $('.update').click(function(){
            let ten = $('.name').val();
            let status = $('.status').val();
            $.ajax({
                type: "put",
                url: "admin/category/"+id,
                data: {
                    name : ten,
                    status : status,
                    id : id,
                },
                dataType: "json",
                success: function ($result) {
                    console.log($result);
                    if($result.errors == 'true'){
                        $('.error').show();
                        $('.error').text($result.message.name[0]);
                    }else{
                        $('#edit').modal('hide');
                        location.reload();
                        toastr.success($result.success, 'Thông báo', {timeOut: 5000});
                    }
                }
            });
        });
    });


    //Delete Category
    $('.delete').click(function(){
        let id = $(this).data('id');
        $.ajax({
            type: "delete",
            url: "admin/category/"+id,
            dataType: "json",
            success: function ($result) {
                $('.del').click(function(){
                    $('#delete').modal('hide');
                    location.reload();
                    toastr.success($result.success, 'Thông báo', {timeOut: 5000});
                });
            }
        });
    });




    // PRODUCT_TYPES
    // Edit Producttype
    $('.editProductType').click(function(){
        $('.error').hide();
        let id = $(this).data('id');
        $.ajax({
            type: "get",
            url: "admin/producttype/"+id+"/edit",
            dataType: "json",
            success: function ($result) {
                $('.name').val($result.producttype.name);
                var html = '';
                $.each($result.category, function ($key, $value) {
                    if($value['id']==$result.producttype.idCategory){
                        html+='<option value='+$value['id']+' selected>';
                        html+=$value['name'];
                        html+='</option>';
                    }
                    else{
                        html+='<option value='+$value['id']+'>';
                        html+=$value['name'];
                        html+='</option>';

                    }
                });
                $('.idCategory').html(html);
                if($result.producttype.status == 1){
                    $('.ht').attr('selected','selected');
                }
                else{
                    $('.kht').attr('selected','selected');
                }
            }
        });
        $('.updateProductType').click(function(){
            let idCategory = $('.idCategory').val();
            let name = $('.name').val();
            let status = $('.status').val();
            $.ajax({
                type: "put",
                url: "admin/producttype/"+id,
                data: {
                    idCategory : idCategory,
                    name : name,
                    status : status,
                    id : id,
                },
                dataType: "json",
                success: function ($data) {
                    console.log($data);
                    if($data.errors == 'true'){
                        $('.error').show();
                        $('.error').text($data.message.name[0]);
                    }else{
                        $('#edit').modal('hide');
                        location.reload();
                        toastr.success($data.result, 'Thông báo', {timeOut: 5000});
                    }
                }
            });
        });
    });


    // Delete Producttype
    $('.deleteProductType').click(function(){
        let id = $(this).data('id');
        $.ajax({
            type: "delete",
            url: "admin/producttype/"+id,
            dataType: "json",
            success: function ($data) {
                $('.delProductType').click(function(){
                    $('#delete').modal('hide');
                    location.reload();
                    toastr.success($data.success, 'Thông báo', {timeOut: 5000});
                });
            }
        });
    });


    //lấy producttype theo category
    $('.cateProduct').change(function () {
        let idCate = $(this).val();
        $.ajax({
            url: "getproducttype",
            data: {
                idCate : idCate
            },
            dataType: "json",
            type: "get",
            success: function ($data) {
                console.log($data);
                let html = '';
                $.each($data,function($key,$value){
                    html += '<option value='+$value['id']+' >';
                    html += $value['name'];
                    html += '</option>';
                });
                $('.proTypeProduct').html(html);
            }
        });
    });




    // PRODUCTS
    // Edit Product
    $('.editProduct').click(function(){
        $('.errorName').hide();
        $('.errorQuantity').hide();
        $('.errorPrice').hide();
        $('.errorPromotional').hide();
        $('.errorDescription').hide();
        $('.errorImage').hide();
        let id = $(this).data('id');
        $.ajax({
            type: "get",
            url: "admin/product/"+id+"/edit",
            dataType: "json",
            success: function ($data) {
                $('.name').val($data.product.name);
                $('.quantity').val($data.product.quantity);
                $('.price').val($data.product.price);
                $('.promotional').val($data.product.promotional);
                CKEDITOR.instances['demo'].setData($data.product.description);
                $('.imageThum').attr('src','img/upload/product/'+$data.product.image);
                if($data.product.status == 1){
                    $('.ht').attr('selected','selected');
                }
                else{
                    $('.kht').attr('selected','selected');
                }

                let html1 = '';
                $.each($data.category, function ($key, $value) {
                    if($value['id']==$data.product.idCategory){
                        html1+='<option value='+$value['id']+' selected>';
                        html1+=$value['name'];
                        html1+='</option>';
                    }
                    else{
                        html1+='<option value='+$value['id']+'>';
                        html1+=$value['name'];
                        html1+='</option>';

                    }
                });
                $('.cateProduct').html(html1);

                let html2 = '';
                $.each($data.producttype, function ($key, $value) {
                    if($value['id']==$data.product.idProductType){
                        html2+='<option value='+$value['id']+' selected>';
                        html2+=$value['name'];
                        html2+='</option>';
                    }
                    else{
                        html2+='<option value='+$value['id']+'>';
                        html2+=$value['name'];
                        html2+='</option>';

                    }
                });
                $('.proTypeProduct').html(html2);
            }
        });
        $('#updateProduct').on('submit',function(e){
            // chặn form submit
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'admin/updatePro/'+id,
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success : function(data){
                    console.log(data);
                    if(data.errors == 'true'){
                        if(data.message.name){
                            $('.errorName').show();
                            $('.errorName').text(data.message.name[0]);
                            $('.name').val('');
                        }
                        if(data.message.quantity){
                            $('.errorQuantity').show();
                            $('.errorQuantity').text(data.message.quantity[0]);
                            $('.quantity').val('');
                        }
                        if(data.message.price){
                            $('.errorPrice').show();
                            $('.errorPrice').text(data.message.price[0]);
                            $('.price').val('');
                        }
                        if(data.message.promotional){
                            $('.errorPromotional').show();
                            $('.errorPromotional').text(data.message.promotional[0]);
                            $('.promotional').val('');
                        }
                        if(data.message.description){
                            $('.errorDescription').show();
                            $('.errorDescription').text(data.message.description[0]);
                            $('.description').val('');
                        }
                        if(data.message.image){
                            $('.errorImage').show();
                            $('.errorImage').text(data.message.image[0]);
                            $('.image').val('');
                        }
                    }
                    else{
                        location.reload();
                        toastr.success(data.result, 'Thông báo', {timeOut: 5000});
                        $('#edit').modal('hide');
                    }
                }
            });
        });

    });

    //delete product
    $('.deleteProduct').click(function(){
        let id = $(this).data('id');
        $.ajax({
            type: "delete",
            url: "admin/product/"+id,
            dataType: "json",
            success: function ($data) {
                $('.delProduct').click(function(){
                    $('#delete').modal('hide');
                    location.reload();
                    toastr.success($data.result, 'Thông báo', {timeOut: 5000});
                });
            }
        });
    });
});
