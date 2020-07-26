<div class="grid-wrapper-headline">
    
    <h1>Checkout</h1>
    
</div>

<div class="grid-wrapper">

    <div class="address">
        <h2>Your address details:</h2>
        <p>
            <strong><?php echo "$user->firstname $user->lastname"; ?></strong>
            <br>
            <?php echo $address->getAddressHtml(); ?>
        </p>
    </div>

    <div class="payment">
        <h2>Your payment details:</h2>
        <p>
            Name: <strong><?php echo $payment->name; ?></strong>
            <br>
            Number: ...<?php echo substr($payment->number, -4); ?>
            <br>
            Expires: <?php echo $payment->expires; ?>
        </p>
    </div>
  
    <div></div>
</div>

<?php require_once __DIR__ . '/partials/productTable.php'; ?>


<div class="grid-wrapper">
    <div>
        <a href="checkout/do-checkout" class="styled-link">Pay</a>
        <a href="cart" class="button_cancel">Discard</a>
    </div>
</div>