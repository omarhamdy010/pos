$(document).ready(function () {

    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();

        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'), 2);

        $(this).removeClass('btn-success').addClass('btn-default disabled');
        // <td><input type="hidden" name="products[]" value="${id}"></td>

        var html = `<tr>
        <td>${name}</td>
        <td><input type="number" name="products[${id}][quanities]" data-price="${price}" min="1" value="1" class="form-control input-sm product-quantity"></td>
        <td class="product-price">${price}</td>
        <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"> <span class="fa fa-trash"></span></button></td>
        </tr>`;

        $('.order-list').append(html);

        calculate_price();
    });

    $('body').on('click', '.disabled', function (e) {
        e.preventDefault()
    });
    $('body').on('click', '.remove-product-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $(this).closest("tr").remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');
        calculate_price();
    });
    $('body').on('keyup change', '.product-quantity', function () {
        var quantity = Number($(this).val());
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));

        $(this).closest('tr').find('.product-price').html($.number(unitPrice * quantity, 2));
        calculate_price();
    });
    $(document).on('click', '.print-btn', function () {

        $('#print-area').printThis();
    });
    $('.order-products').on('click', function (e) {
        e.preventDefault();
        $('#loading').css('display', 'flex');

        var url = $(this).data('url');
        var method = $(this).data('method');

        $.ajax({
            url: url,
            method: method,
            success: function (data) {

                $('#loading').css('display', 'none');
                $('#order-product-list').empty();
                $('#order-product-list').append(data);
            }
        })
    });
});

function calculate_price() {
    var price = 0;
    $('.order-list .product-price').each(function (index) {
        price += parseFloat($(this).html().replace(/,/g, ''));
    });
    $('.total-price').html($.number(price, 2));
    if (price > 0) {
        $('#add-order-form-btn').removeClass('disabled');
    } else {
        $('#add-order-form-btn').addClass('disabled');

    }
}

//
// $(document).ready(function () {
//
//     //change product quantity
//     $('body').on('keyup change', '.product-quantity', function() {
//
//         var quantity = Number($(this).val()); //2
//         var unitPrice = parseFloat($(this).data('price').replace(/,/g, '')); //150
//         console.log(unitPrice);
//         $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice, 2));
//         calculateTotal();
//
//     });//end of product quantity change
//
//     //list all order products
//     $('.order-products').on('click', function(e) {
//
//         e.preventDefault();
//
//         $('#loading').css('display', 'flex');
//
//         var url = $(this).data('url');
//         var method = $(this).data('method');
//         $.ajax({
//             url: url,
//             method: method,
//             success: function(data) {
//
//                 $('#loading').css('display', 'none');
//                 $('#order-product-list').empty();
//                 $('#order-product-list').append(data);
//
//             }
//         })
//
//     });//end of order products click
//
//     //print order
//     $(document).on('click', '.print-btn', function() {
//
//         $('#print-area').printThis();
//
//     });//end of click function
//
// });//end of document ready

