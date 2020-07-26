<div class="grid-wrapper-headline">
    <h1>Edit order: #<?php echo $order->id; ?></h1>
</div>

<div class="grid-wrapper">

    <form action="orders/<?php echo $order->id; ?>/do-edit" method="post">

        <div>
            <label for="status">Status of order</label>
            <select name="status" id="status">
                <?php
                
                    $stati = [
                        'open' => 'Open',
                        'in progress' => 'In Progress',
                        'in delivery' => 'In Delivery',
                        'storno' => 'Storno',
                        'delivered' => 'Delivered'
                    ];

                    foreach ($stati as $htmlValue => $label) {
                    
                        if ($htmlValue === $order->status) {
                            echo "<option value=\"$htmlValue\" selected>$label</option>";
                        } else {
                            echo "<option value=\"$htmlValue\">$label</option>";
                        }
                        
                    }

                ?>
            </select>
        
            <label for="customer">Name of customer</label>
            <input class="readonly_input" type="text" name="customer" id="customer" readonly value="<?php echo $user->firstname . ' ' . $user->lastname; ?>">

            <br>
            <label for="email">Email Address of customer</label>
            <input class="readonly_input" type="email" id="email" name="email" readonly value="<?php echo $user->email; ?>">
        </div>

        <div>
            <label for="delivery_address">Delivery Address of customer</label>
            <textarea name="delivery_address" id="delivery_address" rows="5"><?php echo $delivery_address->address; ?></textarea>
        </div>

        <div>
            <label for="invoice_address">Invoice Address of customer</label>
            <textarea name="invoice_address" id="invoice_address" rows="5"><?php echo $invoice_address->address; ?></textarea>
        </div>
    
        <a href="dashboard" class="button_cancel">Cancel</a>

        <button type="submit">Save</button>
    </form>

    <div></div>
    
    
</div>

<div class="grid-wrapper-headline">
    <h2 class="overview_order">Overview of ordered magazines:</h2>
</div>

<div>
    <?php
        $products = $order->getProducts();
        require_once __DIR__ . '/../partials/productTable.php';
    ?>
</div>