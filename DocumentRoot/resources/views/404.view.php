
<div class="grid-wrapper-headline">
    
    <h1>Sorry! </h1>
    
</div>

<div class="grid-wrapper">
    <?php

        $_message = "We couldn't find the page you were looking for.";

        if (isset($message)) {
            $_message = $message;
        }

        echo $_message;

    ?>
</div>


