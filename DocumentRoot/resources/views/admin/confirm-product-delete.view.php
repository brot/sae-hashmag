<div class="grid-wrapper-headline">
    
    <h1>Delete following product: </h1>
    
</div>

<div class="grid-wrapper">

    <div>

        <p class="p_less_margin">
            If you agree, <strong> <?php echo "{$product->name}"; ?> </strong> will be deleted.
        </p>

        <a href="dashboard/products/do-delete/<?php echo $product->id; ?>" class="button_cancel">I agree!</a>

        <a href="products" class="styled-link">Discard</a>

    </div>
</div>
