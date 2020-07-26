<div class="grid-wrapper-headline">
    
    <h1>Edit Account: #<?php echo $user->id; ?></h1>
    
</div>

<div class="grid-wrapper">
    <div>
        <?php
      
        $flashMessage = \Core\Session::get('flash', null, true);

        if ($flashMessage !== null) {
            echo "<div class=\"alert alert-success\">$flashMessage</div>";
        }
        ?>

        <form action="dashboard/accounts/do-edit/<?php echo $user->id; ?>" method="post">

            <div>
                <label for="firstname">First Name</label>
                <input name="firstname" class="form-control" placeholder="First Nam" type="text" value="<?php echo $user->firstname; ?>">
            </div>

            <div>
                <label for="lastname">Last Name</label>
                <input name="lastname" class="form-control" placeholder="Last Name" type="text" value="<?php echo $user->lastname; ?>">
            </div>

            <div>
                <label for="email">E-mail Address</label>
                <input name="email" class="form-control" placeholder="E-mail Address" type="email" value="<?php echo $user->email; ?>">
            </div>

            <div>
                <label for="password">Password</label>
                <input class="form-control" placeholder="******" type="password" name="password">
            </div> 
            
            <div>
                <label for="password2">Please reapeat password</label>
                <input class="form-control" placeholder="******" type="password" name="password2">
            </div>

            <div class="form-group form-check">
                <?php
             
                $isCheckedParticle = '';

                if ($user->is_admin === true) {
                    $isCheckedParticle = ' checked';
                }
                ?>
                <input type="checkbox" class="form-check-input" name="isAdmin"<?php echo $isCheckedParticle?>>
                <label for="isAdmin" class="form-check-label">Is Admin?</label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div> 
        </form>
    </div>
    
    <div></div>
</div>