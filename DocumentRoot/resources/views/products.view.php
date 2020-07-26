<div class="grid-wrapper-headline">
    
    <h1>Our magazines</h1>
    
</div>

<div class="grid-wrapper">

    <p>
        The London Design Festival kicks off on Monday next week (17 September) so we’re taking the chance to showcase the very best of design in independent publishing. From different pages that flow like a chain of thought, to discussions on any replica furniture, minimalism, and advice on how to overcome creative blocks, we present 10 of our favourite design magazines.
    </p>

    <p>
        Adding an extra fold to Real Review rethinks the structure of this magazine about architecture and critical thought. We love the decision to print on cheap, glossy paper, elevating it with smart design and accessible, engaging writing. Every page of IdN (International Designers’ Network) is crammed with design inspiration. 
    </p>

    <div></div>

</div>

<div class="all_magazin">
    <?php foreach ($products as $product): ?>
        <div class="magazin">
            <h2> <a href="products/<?php echo $product->id; ?>"><?php echo $product->name; ?></a></h2>
            <?php if (!empty($product->images)): ?>
                <img class="magazin_cover" src="storage/<?php echo $product->images[0]; ?>" alt="<?php echo $product->name; ?>" style="max-width: 250px; height: auto;">
            <?php endif; ?>
            <p> <?php echo $product->description . " "; ?><a class="link-more-information" href="products/<?php echo $product->id; ?>"> More information</a> about this issue!</p>
            <p class="price"><?php echo $product->getPrice(); ?></p>
            <a href="cart/add/<?php echo $product->id; ?>" class="styled-link">Add to cart</a>
        </div>
    <?php endforeach; ?>
</div>

