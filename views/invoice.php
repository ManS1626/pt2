<?php
ob_start();
?>
 
<div class="card shadow border-0 border-start border-5 border-warning mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-1">Invoice</h2>
                <p class="text-muted mb-0">Order #<?= htmlspecialchars($order['fld_order_num']) ?></p>
            </div>
            <div class="col-auto">
                <button type="button" onclick="window.print()" class="btn btn-dark"><i class="bi bi-printer me-1"></i>Print</button>
            </div>
        </div>
    </div>
</div> 
<div class="card shadow-sm border-warning border-opacity-50">
    <div class="card-body p-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>CÉLESTE</h4>
                <p class="text-muted mb-0">Sales Invoice</p>
            </div>
            <div class="col-md-6 text-md-end">
                <strong>Invoice No.: </strong><?= htmlspecialchars($order['fld_order_num']) ?><br>
                <strong>Date: </strong><?= htmlspecialchars($order['fld_order_date']) ?>
            </div>
        </div>
        <hr>
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Customer</strong><br>
                <?= htmlspecialchars($order['fld_customer_name'] ?? $order['fld_customer_num']) ?><br>
                <?= htmlspecialchars($order['fld_customer_phone'] ?? '') ?>
            </div>
            <div class="col-md-6 text-md-end">
                <strong>Staff</strong><br>
                <?= htmlspecialchars($order['fld_staff_name'] ?? $order['fld_staff_num']) ?><br>
                <?= htmlspecialchars($order['fld_staff_email'] ?? '') ?>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $grandTotal = 0; $i = 1; ?>
                    <?php if (!empty($details)): ?>
                        <?php foreach ($details as $detail): ?>
                            <?php
                            $unitPrice = (float) ($detail['fld_product_price'] ?? 0);
                            $qty       = (int) ($detail['fld_order_detail_quantity'] ?? 0);
                            $lineTotal = $unitPrice * $qty;
                            $grandTotal += $lineTotal;
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($detail['fld_product_name'] ?? $detail['fld_product_num']) ?></td>
                                <td>$<?= number_format($unitPrice, 2) ?></td>
                                <td><?= $qty ?></td>
                                <td class="text-end">$<?= number_format($lineTotal, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">No products added to this order</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot><tr><th colspan="4" class="text-end">Grand Total</th><th class="text-end">$<?= number_format($grandTotal, 2) ?></tr></tfoot>
            </table>
        </div>
        <a href="<?= BASE_URL ?>orderdetailcontroller/index/<?= rawurlencode($order['fld_order_num']) ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Back to Details</a>
    </div>
</div>


<style>
@media print {
    @page {
        size: A4 portrait;
        margin: 10mm;
    }

    /* Hide everything on the page first */
    body * {
        visibility: hidden !important;
    }

    /* Remove layout spacing and wrappers */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: auto !important;
        overflow: visible !important;
    }

    /* Show only the invoice card */
    .card.shadow-sm,
    .card.shadow-sm * {
        visibility: visible !important;
    }

    /* Place invoice at the top of the page */
    .card.shadow-sm {
        position: static !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        background: white !important;
    }

    .card.shadow-sm .card-body {
        padding: 10px !important;
    }

    /* Hide buttons */
    .btn,
    .btn * {
        display: none !important;
    }

    /* Compact invoice formatting */
    body {
        font-family: Arial, sans-serif !important;
        font-size: 10px !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    h4 {
        font-size: 16px !important;
    }

    .table {
        font-size: 9px !important;
        border-collapse: collapse !important;
    }

    .table th,
    .table td {
        padding: 5px !important;
    }

    .table thead th {
        background-color: #212529 !important;
        color: white !important;
    }
    /* Remove the Bootstrap layout spacing */
    .container,
    .container-fluid,
    .row,
    .col,
    .col.bg-light,
    .p-4 {
        margin: 0 !important;
        padding: 0 !important;
    }
}
</style>

 
<?php
$content = ob_get_clean();
require_once 'layout.php';
?>