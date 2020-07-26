<div class="grid-wrapper-headline">
    
    <h1>Your Orders:</h1>
    
</div>

<div class="grid-wrapper">
    <div>
        <?php
        
            $flashMessage = \Core\Session::get('flash', null, true);

            if ($flashMessage !== null) {
                echo "<div class=\"alert alert-success\">$flashMessage</div>";
            }

        ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Oder Date</th>
                <th>Total Price</th>
                <th>Delivery Address</th>
                <th>Products</th>
                <th>Current Status</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order->id; ?></td>
                    <td><?php echo $order->crdate; ?></td>
                    <td><?php echo \App\Models\Product::formatPrice($order->getPrice()); ?></td>
                    <td>
                        <?php
                        
                            $address = $order->getDeliveryAddress();

                            echo $address->getAddressHtml();

                        ?>
                    </td>
                    <td>
                        <ul>
                            <?php foreach ($order->getProducts() as $product): ?>
                                <li><?php echo "{$product->quantity}x $product->name"; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td><?php echo $order->status; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>