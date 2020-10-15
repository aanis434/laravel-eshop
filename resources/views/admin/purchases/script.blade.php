<script>
    function totalPrice(row) {
        let price = parseInt($(`#price_${row}`).val());
        let qty = parseInt($(`#qty_${row}`).val());
        let totalRow = parseInt($('#purchaseTable').children('tr').length);
        console.log('totalRow', totalRow)

        if (!isNaN(price) && price != 0 && !isNaN(qty) && qty != 0) {
            let total_price = price * qty;
            $(`#total_price_${row}`).val(total_price);

            totalAmount(totalRow);
        }
    };

    function totalAmount(totalRow) {
        let total_amount = 0;
        for (let i = 0; i < totalRow; i++) {
            total_amount += parseInt($(`#total_price_${i}`).val());
        }
        $(`#total_amount`).val(total_amount);
        console.log(total_amount);
    }

    function amountToPay() {
        let paid_amount = parseInt($(`#paid_amount`).val());
        let total_amount = parseInt($(`#total_amount`).val());
        let amount_to_pay = 0;

        if (!isNaN(paid_amount) && paid_amount != 0 && !isNaN(total_amount) && total_amount != 0) {
            if (paid_amount != total_amount && paid_amount < total_amount)
                amount_to_pay = total_amount - paid_amount;

            $(`#amount_to_pay`).val(amount_to_pay);
        }
    }

    function removeRow(row) {
        let rowId = $(`#rowId_${row}`).remove();
    }

    function addRow(row) {
        row++;
        console.log(row);
        let addRow = `<tr id="rowId_${row}">
                    <td>
                        <select class="form-control select2" id="products_${row}" name="products[]">
                            <option value="0">Choose Product</option>
                        <?php
                        foreach ($products as $id => $product) { ?>
                                <option value="{{ $id }}" {{ in_array($id, old('product', [])) ? 'selected' : '' }}>{{ $product }}</option>
                        <?php    }
                        ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control select2" id="units_${row}" name="units[]">
                            <option value="0">Choose Unit</option>
                        <?php
                        foreach ($units as $id => $unit) { ?>
                                <option value="{{ $id }}" {{ in_array($id, old('unit', [])) ? 'selected' : '' }}>{{ $unit }}</option>
                            <?php }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="price[]" id="price_${row}" min="0" onblur="totalPrice('${row}')" class="form-control" required>
                    </td>
                    <td>
                        <input type="number" name="qty[]" id="qty_${row}" min="0" onblur="totalPrice('${row}')" class="form-control" required>
                    </td>
                    <td>
                        <input type="number" name="total_price[]" id="total_price_${row}" min="0" class="form-control" readonly>
                    </td>
                    <td class="form-inline">
                        <input type="button" value="+" class="btn btn-sm btn-success addRow" class="form-control" onclick="addRow('${row}')"> &nbsp;
                        <input type="button" value="-" class="btn btn-sm btn-warning" onclick="removeRow('${row}')" class="form-control">
                    </td>
                </tr>`;
        $('#purchaseTable tr:last').after(addRow);
    }
</script>