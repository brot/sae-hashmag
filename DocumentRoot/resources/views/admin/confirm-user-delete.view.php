<div class="grid-wrapper-headline">
    
    <h1>Delete following account: </h1>
    
</div>

<div class="grid-wrapper">

    <div>

        <p class="p_less_margin">
            If you agree, <strong> <?php echo "{$user->firstname} {$user->lastname}"; ?> </strong> will be deleted.
        </p>

        <a href="dashboard/accounts/do-delete/<?php echo $user->id; ?>" class="button_cancel">I agree!</a>

        <a href="dashboard/accounts" class="styled-link">Discard</a>

    </div>
</div>
