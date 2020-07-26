<div class="grid-wrapper-headline">
    <h1>Your Dashboard</h1>
</div>

<div class="grid-wrapper dashboard">

    <div class="dashboard_card">
        <h2>Edit products:</h2>

        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <span class="container_product_delete">

                        <a href="products/<?php echo $product->id; ?>/edit">
                            <?php echo $product->name;?>:
                        </a>

                        <br> 

                        <!-- TODO PRODUCT DELETE -->

                        <a href="dashboard/products/delete/<?php echo $product->id; ?>">
                            <svg class="icon_delete" version="1.1" x="0" y="0" viewBox="0 0 310.4 407" xml:space="preserve">
                                <path class="st0" d="M89.2 37c0-12.1 9.5-21 21.6-21h88.8c12.1 0 21.6 8.9 21.6 21v23h16V37c0-21-16.6-37-37.6-37h-88.8c-21 0-37.6 16-37.6 37v23h16V37zM60.6 407h189.2c18.2 0 32.4-16 32.4-36V124h-254v247c0 20 14.2 36 32.4 36zm145.6-244.8c0-4.4 3.6-8 8-8s8 3.6 8 8v189c0 4.4-3.6 8-8 8s-8-3.6-8-8v-189zm-59 0c0-4.4 3.6-8 8-8s8 3.6 8 8v189c0 4.4-3.6 8-8 8s-8-3.6-8-8v-189zm-59 0c0-4.4 3.6-8 8-8s8 3.6 8 8v189c0 4.4-3.6 8-8 8s-8-3.6-8-8v-189zM20 108h270.4c11 0 20-9 20-20s-9-20-20-20H20C9 68 0 77 0 88s9 20 20 20z"/>
                            </svg>
                        </a>

                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="dashboard/products/add" class="styled-link">Add product</a>

    </div>

    <div>
        <div class="dashboard_card">
            <h2>Total orders with status <br> "open": <?php echo count($openOrders); ?></h2>
            <ul>
                <?php foreach ($openOrders as $openOrder): ?>
                    <li>
                        <a href="orders/<?php echo $openOrder->id; ?>/edit">
                            <?php printf('#%d: %s', $openOrder->id, $openOrder->crdate); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="dashboard_card">
            <h2>Total orders with status <br> "in progress": <?php echo count($inProgress); ?></h2>
            <ul>
                <?php foreach ($inProgress as $inProgress): ?>
                    <li>
                        <a href="orders/<?php echo $inProgress->id; ?>/edit">
                            <?php printf('#%d: %s', $inProgress->id, $inProgress->crdate); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="dashboard_card">
            <h2>Total orders with status <br> "in delivery": <?php echo count($inDelivery); ?></h2>
            <ul>
                <!-- TO DO ALEX: warum $inDeliveries Undefined variable: -->
                <?php foreach ($inDelivery as $inDelivery): ?>
                    <li>
                        <a href="orders/<?php echo $inDelivery->id; ?>/edit">
                            <?php printf('#%d: %s', $inDelivery->id, $inDelivery->crdate); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>


    <div> 
        <div class="dashboard_card">
            <h2>Number of current users in total:</h2>

            <ul>
                <?php
 
                foreach ($numberOfUsers as $numberOfUsersData) {
                    if ($numberOfUsersData['is_admin'] === 1) {
                        $label = 'Admin(s)';
                    } else {
                        $label = 'Customer(s)';
                    }
                    $value = $numberOfUsersData['numberofusers'];

                    echo "<li>$value $label</li>";
                }
                ?>
            </ul>
        </div>

        <div class="dashboard_card">
            <h2>Shipping status of all current orders:</h2>

            <ul>
                <?php foreach ($productStats as $productStat): ?>
                    <li>
                        <?php echo $productStat['label']; ?>: <?php echo $productStat['count']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>


    <div class="dashboard_card">
        <h2>Summary of all products: <?php echo count($products); ?></h2>

        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <span>
                        <?php echo $product->name; ?>: <br>
                    </span>

                    <span>
                        Price: <?php echo $product->getPrice(); ?> <br>
                    </span>

                    <span>
                        Current Stock: <?php echo $product->stock; ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

