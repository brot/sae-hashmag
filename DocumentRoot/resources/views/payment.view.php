<div class="grid-wrapper-headline">
    
    <h1>Your Payment</h1>
    
</div>

<div class="grid-wrapper">

    <div>
        <div class="chose-payment">
            <h3>Choose Payment</h3>
    

            <?php foreach ($errors as $error): ?>
                <p id="error_message_checkout"><?php echo $error; ?></p>
            <?php endforeach; ?>

            <form action="checkout/handle-payment" method="post">
                <div>
                    <label for="payment">Choose payment</label>
                    <select id="payment" name="payment">
                        <option value="_default" selected hidden>Please select your payment</option>
                        <?php foreach ($payments as $payment): ?>
                            <option value="<?php echo $payment->id; ?>"><?php echo $payment->name; ?>: ...<?php echo substr($payment->number, -4); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button>Choose!</button>
            </form>
        </div>

        <div>
            <h3>Create New Payment</h3>

            <form action="checkout/handle-payment" method="post">

                <div>
                    <label for="name">Card Owner</label>
                    <input id="name" type="text" name="name" placeholder="John Doe">
                </div>

                <div>
                    <label for="number">Number</label>
                    <input id="number" type="text" name="number" placeholder="1234 1234 1234 1234">
                </div>

                <div>
                    <label for="expires">Expires</label>
                    <input id="expires" type="text" name="expires" placeholder="0622">
                </div>

                <div>
                    <label for="ccv">CCV</label>
                    <input id="ccv" type="number" name="ccv" placeholder="123">
                </div>

                <button>Save</button>

            </form>

        </div>

    </div>

    <div></div>

</div>
