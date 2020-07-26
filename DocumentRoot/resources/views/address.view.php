<div class="grid-wrapper-headline">
    
    <h1>Your address</h1>
    
</div>

<div class="grid-wrapper">

    <div>
        <div class="chose-payment">
            <h3>Choose address</h3>

            <?php foreach ($errors as $error): ?>
                <p id="error_message_checkout"><?php echo $error; ?></p>
            <?php endforeach; ?>
            
            <form action="checkout/handle-address" method="post">
                <div>
                    <label for="address_id">Choose address</label>
                    <select id="address_id" name="address_id">
                        <option value="_default" selected hidden>Please select your address</option>
                        <?php foreach ($addresses as $address): ?>
                            <option value="<?php echo $address->id; ?>"><?php echo $address->address; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button>Choose</button>
            </form>
        </div>

        <div class="add-payment">
            <h3>Create new address</h3>
            <form action="checkout/handle-address" method="post">
                <div>
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="5" placeholder="Main Street 24, 2345 Perth, Australia"></textarea>
                </div>

                <button>Save</button>
            </form>
        </div>
    </div>

    <div></div>
</div>
