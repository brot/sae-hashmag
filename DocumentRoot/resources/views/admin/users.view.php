<div class="grid-wrapper-headline">
    
    <h1>Accounts:</h1>
    
</div>

<div class="grid-wrapper">
    <table class="table table-striped">

        <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Role as admin?</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php echo $user->id; ?>
                    </td>

                    <td>   
                        <?php echo $user->email; ?>
                    </td>

                    <td>
                        <?php echo ($user->is_admin === true ? 'yes': 'no'); ?>
                    </td>
                    
                    <td>
                        <a href="dashboard/accounts/edit/<?php echo $user->id; ?>" class="action_button_table-cancel">Edit</a>

                        <?php
                            if (\App\Models\User::getLoggedInUser()->id !== $user->id): ?>
                                <a href="dashboard/accounts/delete/<?php echo $user->id; ?>" class="action_button_table">Delete</a>
                        <?php endif; ?>

                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
