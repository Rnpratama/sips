<section class="content-header">
    <h1>Sale
        <small>Penjualan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li>Transaction</li>
        <li class="active">Sale</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- Form to input date, cashier, and customer -->
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Date</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" id="date" value="<?=date('Y-m-d')?>" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; width:30%">
                                <label for="user">Kasir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="user" value="<?=$this->fungsi->user_login()->name?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">
                                <label for="customer">Customer</label>
                            </td>
                            <td>
                               <div>
                                    <select id="customer" class="form-control">
                                        <option value="">Umum</option>
                                        <?php foreach($customer as $cust => $value){ ?>
                                            <option value="<?=$value->customer_id?>"><?=$value->name?></option>
                                        <?php } ?>
                                    </select>
                               </div> 
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form to input barcode, quantity, and add to cart -->
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="qty">Qty</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="qty" value="1" min="1" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div>
                                    <button type="button" id="add_cart" class="btn btn-primary">
                                        <i class="fa fa-cart-plus"></i> Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Invoice summary and grand total -->
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <div align="right">
                        <h4>Invoice <b><span id="invoice"><?=$invoice?></span></b></h4>
                        <h1><b><span id="grand-total" style="font-size: 50pt;">0</span></b></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart table to show added items -->
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Item</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th width="10%">Discount Item</th>
                                <th width="15%">Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cart-table">
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada item</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment details and total calculation -->
    <div class="row">
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top; width: 30%">
                                <label for="sub_total">Sub Total</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="sub_total" value="" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">
                                <label for="discount">Discount</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="discount" value="0" min="0" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">
                                <label for="grand_total">Grand Total</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="grand_total" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Cash input and change calculation -->
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top; width:30%">
                                <label for="cash">Cash</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="cash" value="0" min="0" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="change">Change</label>
                            </td>
                            <td>
                                <div>
                                    <input type="number" id="change" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Notes and buttons for canceling or processing payment -->
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="note">Note</label>
                            </td>
                            <td>
                                <div>
                                    <textarea id="note" rows="3" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div>
                <button id="cancel-payment" class="btn btn-flat btn-warning">
                    <i class="fa fa-refresh"></i> Cancel
                </button><br><br>
                <button id="process_payment" class="btn btn-flat btn-lg btn-success">
                    <i class="fa fa-paper-plane-o"></i> Process Payment
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Modal to select product item -->
<div class="modal fade" id="modal-item" tabindex="-1" role="dialog" aria-labelledby="modalItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalItemLabel">Select Product Item</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item as $i => $data) { ?>
                        <tr>
                            <td><?= htmlspecialchars($data->name) ?></td>
                            <td><?= htmlspecialchars($data->unit_name) ?></td>
                            <td class="text-right"><?= indo_currency($data->price) ?></td>
                            <td class="text-right"><?= htmlspecialchars($data->stock) ?></td>
                            <td class="text-right">
                                <button class="btn btn-xs btn-info select-item"
                                    data-id="<?= htmlspecialchars($data->item_id) ?>"
                                    data-barcode="<?= htmlspecialchars($data->barcode) ?>"
                                    data-name="<?= htmlspecialchars($data->name) ?>"
                                    data-unit="<?= htmlspecialchars($data->unit_name) ?>"
                                    data-price="<?= htmlspecialchars($data->price) ?>"
                                    data-stock="<?= htmlspecialchars($data->stock) ?>">
                                    <i class="fa fa-check"></i> Select
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
   $(document).ready(function () {
        // Fungsi utama untuk memuat data cart saat halaman dibuka
        function load_cart() {
            $.ajax({
                url: '<?= site_url('sale/load_cart') ?>',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var html = '';
                    var grandTotal = 0;

                    if (data.length === 0) {
                        html = '<tr><td colspan="9" class="text-center">Tidak ada item</td></tr>';
                    } else {
                        data.forEach(function (item, index) {
                            html += `<tr>
                                <td>${index + 1}</td>
                                <td>${item.product_name}</td>
                                <td class="text-right">${item.price}</td>
                                <td class="text-right">${item.qty}</td>
                                <td class="text-right">${item.discount}</td>
                                <td class="text-right">${item.total}</td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-danger remove-item" data-id="${item.cart_id}">
                                        <i class="fa fa-trash"></i> Remove
                                    </button>
                                </td>
                            </tr>`;
                            grandTotal += parseFloat(item.total) || 0;
                        });
                    }

                    // Tampilkan cart di tabel
                    $('#cart-table').html(html);

                    // Update total dan grand total di invoice
                    $('#grand-total').text(grandTotal.toLocaleString('id-ID', { maximumFractionDigits: 0 }));
                    $('#sub_total').val(grandTotal);
                    $('#grand_total').val(grandTotal);

                    // Hitung ulang kembalian jika sudah ada inputan cash
                    update_grand_total();
                }
            });
        }

        // Fungsi untuk mencetak invoice dengan layout rapih
        function print_invoice() {
            var htmlItems = '';
            $('#cart-table tr').each(function () {
                var name = $(this).find('td').eq(2).text();
                var qty = $(this).find('td').eq(4).text();
                var price = $(this).find('td').eq(3).text();

                htmlItems += `
                    <tr>
                        <td>${name}</td>
                        <td class="text-right">${qty}</td>
                        <td class="text-right">${price}</td>
                    </tr>
                `;
            });

            var invoiceContent = `
                <html>
                    <head>
                        <style>
                            body { font-family: Arial, sans-serif; font-size: 14px; }
                            .invoice-header { text-align: center; margin-bottom: 20px; }
                            .invoice-header h1 { margin: 0; }
                            .invoice-details, .invoice-items { width: 100%; margin-top: 20px; border-collapse: collapse; }
                            .invoice-details td, .invoice-items td, .invoice-items th { border: 1px solid #ddd; padding: 8px; }
                            .invoice-details th, .invoice-items th { text-align: left; }
                            .invoice-items th { background-color: #f2f2f2; }
                            .text-right { text-align: right; }
                            .text-center { text-align: center; }
                        </style>
                    </head>
                    <body>
                        <div class="invoice-header">
                            <h1>Invoice</h1>
                            <p><strong>Invoice No:</strong> ${$('#invoice').text()}</p>
                            <p><strong>Date:</strong> ${$('#date').val()}</p>
                            <p><strong>Cashier:</strong> ${$('#user').val()}</p>
                            <p><strong>Customer:</strong> ${$('#customer option:selected').text()}</p>
                        </div>

                        <table class="invoice-items">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${htmlItems}
                            </tbody>
                        </table>

                        <table class="invoice-details">
                            <tr>
                                <td><strong>Sub Total:</strong></td>
                                <td class="text-right">${$('#sub_total').val()}</td>
                            </tr>
                            <tr>
                                <td><strong>Discount:</strong></td>
                                <td class="text-right">${$('#discount').val()}</td>
                            </tr>
                            <tr>
                                <td><strong>Grand Total:</strong></td>
                                <td class="text-right">${$('#grand_total').val()}</td>
                            </tr>
                            <tr>
                                <td><strong>Cash:</strong></td>
                                <td class="text-right">${$('#cash').val()}</td>
                            </tr>
                            <tr>
                                <td><strong>Change:</strong></td>
                                <td class="text-right">${$('#change').val()}</td>
                            </tr>
                        </table>

                        <p><strong>Note:</strong> ${$('#note').val()}</p>
                    </body>
                </html>
            `;

            var printWindow = window.open('', '', 'height=800,width=600');
            printWindow.document.write(invoiceContent);
            printWindow.document.close();
            printWindow.print();
        }

        function clear_cart() {
    $.ajax({
        url: '<?= site_url('sale/clear_cart') ?>',  // Gantilah URL dengan endpoint yang sesuai
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                console.log('Cart cleared successfully.');
            } else {
                alert('Gagal menghapus data cart.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data cart.');
        }
    });
}

        // Proses Pembayaran (Tombol Process Payment)
        $('#process_payment').click(function() {
    var items = get_cart_items(); // Ambil item cart
    print_invoice();

    if (items.length === 0) {
        alert('Cart kosong. Silakan tambahkan item terlebih dahulu.');
        return;
    }

    // Data yang dikirim dalam bentuk array, bukan JSON string
    $.ajax({
        url: '<?= site_url('sale/save_sale') ?>',
        type: 'POST',
        data: {
            invoice: $('#invoice').text(),
            date: $('#date').val(),
            cashier: $('#user').val(),
            customer: $('#customer').val(),
            sub_total: $('#sub_total').val(),
            discount: $('#discount').val(),
            grand_total: $('#grand_total').val(),
            cash: $('#cash').val(),
            change: $('#change').val(),
            note: $('#note').val(),
            items: JSON.stringify(items)  // Kirim sebagai JSON string
           // items: items  // Mengirimkan data dalam bentuk array
        },
        
    });
    clear_cart();
    load_cart();
    location.reload();  // Refresh halaman setelah print selesai
});



function reset_form() {
    $('#sub_total').val('');
    $('#discount').val('0');
    $('#grand_total').val('');
    $('#cash').val('0');
    $('#change').val('0');
    $('#note').val('');
}


        // Fungsi untuk mendapatkan item cart dalam bentuk array
        function get_cart_items() {
    var items = [];
    $('#cart-table tr').each(function() {
        var item = {
            product_name: $(this).find('td').eq(2).text(),
            price: parseFloat($(this).find('td').eq(3).text().replace(/[^0-9.-]+/g, "")),  // Mengonversi ke float
            qty: parseInt($(this).find('td').eq(4).text(), 10),  // Mengonversi qty ke integer
            discount: parseFloat($(this).find('td').eq(5).text().replace(/[^0-9.-]+/g, "")),  // Mengonversi ke float
            total: parseFloat($(this).find('td').eq(6).text().replace(/[^0-9.-]+/g, ""))  // Mengonversi ke float
        };
        
        // Pastikan item memiliki nama produk, harga, dan jumlah
        if (item.product_name && !isNaN(item.price) && !isNaN(item.qty)) {
            items.push(item);
        }
    });

    console.log("Items:", items);  // Debugging: pastikan items yang dikirim valid
    console.log(JSON.stringify(items)); // Log untuk melihat data dalam bentuk JSON

    return items;
}


    // console.log("Items:", items);  // Debugging: pastikan items yang dikirim valid
    // console.log(JSON.stringify(items)); // Log untuk melihat data dalam bentuk JSON

// if ($('#cart-table tr').length === 0) {
//     alert('Cart kosong. Silakan tambahkan item terlebih dahulu.');
//     return;
// }}




        // Tambahkan item ke cart
        $('#add_cart').click(function () {
            var item_id = $('#item_id').val();
            var price = $('#price').val();
            var qty = $('#qty').val();
            var discount = 0;
            var total = price * qty;

            if (!item_id || !price || !qty || qty <= 0) {
                alert('Data tidak valid');
                return;
            }

            $.ajax({
                url: '<?= site_url('sale/save_cart') ?>',
                type: 'POST',
                data: {
                    item_id: item_id,
                    price: price,
                    qty: qty,
                    discount: discount,
                    total: total
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        load_cart();
                    } else {
                        alert(response.message);
                    }
                }
            });
        });

        // Hapus item dari cart
        $(document).on('click', '.remove-item', function () {
            var cart_id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                $.ajax({
                    url: '<?= site_url('sale/remove_cart') ?>',
                    type: 'POST',
                    data: { cart_id: cart_id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            load_cart();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        });

        // Hitung total, diskon, dan kembalian secara real-time
        $('#discount, #cash').on('input keyup', function () {
            update_grand_total();
        });

        function update_grand_total() {
            var subTotal = parseFloat($('#sub_total').val()) || 0;
            var discount = parseFloat($('#discount').val()) || 0;
            var grandTotal = subTotal - discount;

            $('#grand_total').val(grandTotal.toLocaleString('id-ID'));

            var cash = parseFloat($('#cash').val()) || 0;
            var change = cash - grandTotal;

            $('#change').val(change > 0 ? change.toLocaleString('id-ID') : '0');
        }

        // Pilih item dari modal dan masukkan ke form
        $(document).on('click', '.select-item', function () {
            let itemId = $(this).data('id');
            let barcode = $(this).data('barcode');
            let name = $(this).data('name');
            let unit = $(this).data('unit');
            let price = $(this).data('price');
            let stock = $(this).data('stock');

            $('#item_id').val(itemId);
            $('#barcode').val(barcode);
            $('#price').val(price);
            $('#stock').val(stock);

            $('#modal-item').modal('hide');
        });

        // Muat cart saat halaman dimuat
        load_cart();
    });
</script>


