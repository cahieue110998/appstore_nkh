$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    $('.qty').blur(function(){
        let rowId = $(this).data('id');
        $.ajax({
            type: "put",
            url: "cart/"+rowId,
            data: {
                qty : $(this).val(),
            },
            dataType: "json",
            success: function (data) {
                if(data.error){
                    toastr.error(data.error, 'Thông báo', {timeOut: 5000});
                }
                else{
                    toastr.success(data.result, 'Thông báo', {timeOut: 5000});
                    location.reload();
                }
            }
        });
    });

    $('.close1').click(function(){
        $('#delete').modal('show');
        let rowId = $(this).data('id');
        $('.delProduct').click(function(){
            $.ajax({
                type: "delete",
                url: "cart/"+rowId,
                dataType: "json",
                success: function (data) {
                    $('#delete').modal('hide');
                    toastr.success(data.result, 'Thông báo', {timeOut: 5000});
                    location.reload();
                }
            });
        });
    });

    //Add customer
    $('.addAddress').click(function(){
        $('.errorEmail').hide();
        $('.errorPhone').hide();
        $('.errorAddress').hide();
        var active = '';
        if($('.actives').prop('checked')){
            active = 'on';
        }
        else{
            active = 'off';
        }
        $.ajax({
            type: "post",
            url: "customer",
            data: {
                email : $('.email').val(),
                phone : $('.phone').val(),
                address : $('.address').val(),
                active : active,
            },
            dataType: "json",
            success: function(data){
                console.log(data);
                if(data.errors == 'true'){
                    if(data.message.phone){
                        $('.errorPhone').show();
                        $('.errorPhone').text(data.message.phone[0]);
                    }
                    if(data.message.address){
                        $('.errorAddress').show();
                        $('.errorAddress').text(data.message.address[0]);
                    }
                }
                else{
                    location.reload();
                    toastr.success(data, 'Thông báo', {timeOut: 5000});
                    $('#address').modal('hide');
                }
            },
        });
    });

    $('.payment').click(function () {
        var email = '';
        var phone = '';
        var address = '';
        var name = '';
        var note = $('.note').val();
        var paytotal = $('.paytotal').text();
        paytotal = paytotal.replace(' VNĐ','');
        var rdoaddress = $('input[name=rdoaddress]');
        $.each(rdoaddress, function(key,value){
            if(value.checked == true){
                email = value.value;
                phone = $('.phone'+key).text();
                address = $('.address'+key).text();
                name = $('.name'+key).text();
            }
        });
        $.ajax({
            type: "post",
            url: "cart",
            data: {
                email : email,
                phone : phone,
                address : address,
                message : note,
                money : paytotal,
                name : name,
            },
            dataType: "json",
            success: function (data) {
                toastr.success(data, 'Thông báo', {timeOut: 5000});
                location.href = '/';
            }
        });
    });

});
