<script>
    $(document).ready(function() {

        $('.addToCart').click(function() {
            var product_id = $(this).data('id');

            let url = "{{ route('add-to-cart', 'product_id') }}".replace('product_id', product_id);

            var method = "GET";



            $.ajax({
                type: method,
                url: url,
                success: function(response) {
                    // console.log(response);
                    $("#cartCount").text(response.cartCount);
                    $(".cartTotal").text(response.cartTotal);

                },
                error: function(response) {
                    console.log('Error:', response);
                }
            });
        });

    });

    function updateCartQty(rowId) {
        let qty = $(`#updateCartQty_${rowId}`).val();
        // console.log(qty);

        let url = "{{ route('update-cart-item', ['rowId', 'qty']) }}".replace('rowId', rowId).replace('qty', qty);

        // alert(url);
        if (qty == 0) {
            url = "{{ route('remove-cart-item', 'rowId') }}".replace('rowId', rowId);
        }

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                // console.log(response);
                $("#cartCount").text(response.cartCount);
                $(".cartTotal").text(response.cartTotal);
                $(`#updateCartQty_${rowId}`).val(response.incrementQty);
                $(`#updateItemTotal_${rowId}`).text(response.itemTotal);

                if (qty == 0) {
                    $("#cartBody").html(generateCartBody(response.contents))
                };

            },
            error: function(response) {
                console.log('Error:', response);
            }
        });
    }

    function incrementCartQty(rowId) {
        let qty = $(`#updateCartQty_${rowId}`).val();
        // console.log(qty);

        let url = "{{ route('increment-cart-item',['rowId','qty']) }}".replace('rowId', rowId).replace('qty', qty);

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                // console.log(response);
                $("#cartCount").text(response.cartCount);
                $(".cartTotal").text(response.cartTotal);
                $(`#updateCartQty_${rowId}`).val(response.incrementQty);
                $(`#updateItemTotal_${rowId}`).text(response.itemTotal);

            },
            error: function(response) {
                console.log('Error:', response);
            }
        });
    }

    function decrementCartQty(rowId) {
        let qty = $(`#updateCartQty_${rowId}`).val();
        // console.log(qty);

        let url = "{{ route('decrement-cart-item', ['rowId','qty']) }}".replace('rowId', rowId).replace('qty', qty);
        if (qty == 1) {
            url = "{{ route('remove-cart-item', 'rowId') }}".replace('rowId', rowId);
        };

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                // console.log(response);
                $("#cartCount").text(response.cartCount);
                $(".cartTotal").text(response.cartTotal);
                $(`#updateCartQty_${rowId}`).val(response.incrementQty);
                $(`#updateItemTotal_${rowId}`).text(response.itemTotal);

                if (qty == 1) {
                    $("#cartBody").html(generateCartBody(response.contents))
                };

            },
            error: function(response) {
                console.log('Error:', response);
            }
        });
    }

    function removeCartItem(rowId) {
        // console.log('id',rowId);
        let url = "{{ route('remove-cart-item', 'rowId') }}".replace('rowId', rowId);

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                // console.log(response.contents.length);
                $("#cartCount").text(response.cartCount);
                $(".cartTotal").text(response.cartTotal);
                $("#cartBody").html(generateCartBody(response.contents));
                if (response.contents.length == 0)
                    $("#checkout").attr('href', 'javascript:void(0)');
            },
            error: function(response) {
                console.log('Error:', response);
            }
        });
    }

    function generateCartBody(contents) {
        let cartBody = '';

        for (var row in contents) {
            cartBody += `<tr class="">
                        <td class="text-center">
                            <a href="javascript:void(0)" onclick="removeCartItem('${contents[row].rowId}')" class="text-gray-32 font-size-26">×</a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1" src="${contents[row].options.image}" alt="${contents[row].name}"></a>
                        </td>

                        <td data-title="Product">
                            <a href="#" class="text-gray-90">${contents[row].name}</a>
                        </td>

                        <td data-title="Price">
                            <span class="">${contents[row].price}</span>
                        </td>

                        <td data-title="Quantity">
                            <span class="sr-only">Quantity</span>
                            <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                <div class="js-quantity row align-items-center">
                                    <div class="col">
                                        <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" name="qty" onkeyup="updateCartQty('${contents[row].rowId}')" id="updateCartQty_${contents[row].rowId}" type="text" value="${contents[row].qty}">
                                    </div>
                                    <div class="col-auto pr-1">
                                        <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" onclick="decrementCartQty('${contents[row].rowId}')" href="javascript:;">
                                            <small class="fas fa-minus btn-icon__inner"></small>
                                        </a>
                                        <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" onclick="incrementCartQty('${contents[row].rowId}')" href="javascript:;">
                                            <small class="fas fa-plus btn-icon__inner"></small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td data-title="Total">
                            <span id="updateItemTotal_${contents[row].rowId}">${contents[row].subtotal}</span>
                        </td>
                    </tr>`;
        }

        if (cartBody == '') {
            cartBody = `<tr>
                            <td colspan="6" class="text-center">No item found</td>
                        </tr>`;
        };

        return cartBody;
    };
</script>