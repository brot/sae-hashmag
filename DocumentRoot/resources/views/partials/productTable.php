<div class="grid-wrapper">
    <table class="table table-striped">
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <?php
       
                if (isset($isCart) && $isCart === true) {
                    echo "<th>Actions</th>";
                }
                
            ?>
        </tr>
        <?php
        $totalPrice = 0;
        foreach ($products as $product): ?>

            <tr>
                <!-- <td><?php echo $product->id; ?></td> -->
                <td><?php echo $product->name; ?></td>

                <td><?php echo \App\Models\Product::formatPrice($product->price); ?></td>

                <td>
                    <?php if (isset($isCart) && $isCart === true): ?>

                        <form action="cart/update/<?php echo $product->id; ?>" method="post">
                            <div class="input-group">
                                <input type="number" name="quantity" value="<?php echo $product->quantity; ?>" min="1">
                                <div>
                                    <button type="submit">Save</button>
                                </div>
                            </div>
                        </form>

                    <?php else: ?>

                        <?php echo $product->quantity; ?>
                        
                    <?php endif; ?>
                </td>

                <?php
                    $subTotal = $product->price * $product->quantity;
                    $totalPrice = $totalPrice + $subTotal;
                ?>

                <td><?php echo \App\Models\Product::formatPrice($subTotal); ?></td>

                <?php if (isset($isCart) && $isCart === true): ?>

                    <td>
                        <div>
                            <a href="cart/add/<?php echo $product->id; ?>" class="action_button_table">+</a>
                            <a href="cart/sub/<?php echo $product->id; ?>" class="action_button_table">-</a>
                            <a href="cart/remove/<?php echo $product->id; ?>" class="action_button_table">Remove</a>
                        </div>
                    </td>
                    
                <?php endif; ?>
            </tr>

        <?php endforeach; ?>

        <tr class="summary_order">
            <td></td>
            <td></td>
            <td class="total_price_formate">
                <strong>
                    Total:
                </strong>
            </td>
            <td><?php echo \App\Models\Product::formatPrice($totalPrice); ?></td>
            <?php if (isset($isCart) && $isCart === true): ?>
            <td>
                <a href="checkout" class="styled-link">Buy</a>
            </td>
            <?php endif; ?>
        </tr>
    </table>
</div>

