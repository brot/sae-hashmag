<div class="grid-wrapper-headline">
    
    <h1>Your account details</h1>
    
</div>

<div class="grid-wrapper">
   

    <form action="account/do-edit" method="post">

    <?php

        $flashMessage = \Core\Session::get('flash', null, true);

        if ($flashMessage !== null) {
            echo "<div class=\"alert\">$flashMessage</div>";
        }

    ?>

        <div>
            <label for="firstname">First Name</label>
            <input id="firstname" name="firstname" placeholder="Vorname" type="text" value="<?php echo $user->firstname; ?>">
        </div>
        
        <div>
            <label for="lastname">Last Name</label>
            <input id="lastname" name="lastname" placeholder="Nachname" type="text" value="<?php echo $user->lastname; ?>">
        </div>
        
        <div>
            <label for="email">E-mail Address</label>
            <input id="email" name="email" placeholder="Email" type="email" value="<?php echo $user->email; ?>">
        </div>
        
        <div>
            <label for="password">Password</label>
            <input id="password" placeholder="******" type="password" name="password">
        </div> 
        
        <div>
            <label for="password2">Please reapeat password</label>
            <input id="password2" placeholder="******" type="password" name="password2">
        </div>
        
        <div>
            <button type="submit">Save</button>
        </div> 
        
    </form>
    <div></div>
</div>

<div class="grid-wrapper-headline">
    
    <h2>Your orders</h2>
    
</div>

<div class="grid-wrapper">

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