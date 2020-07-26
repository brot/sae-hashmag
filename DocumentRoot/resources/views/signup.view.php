

<div class="grid-wrapper-headline"> 
    <h1>Register here!</h1>
</div>

<div class="grid-wrapper">
    
    <div>
        <p>
            Wondering why we ask you to register? Most probably we have all been there. Just moments after you've placed your order, you get a nice email thanking you for your purchase. But then. Nothing.
            After a couple of days, you still haven't received the order or even a shipping notification. You want to contact the seller about your order, but how?
            And that's the turning point where we change the game. Once you've registered, you are going to have an overview of all placed orders whenever you want. 
        </p>

        <hr>

        <h3>
            Get all the benefits
        </h3>

        <p>
            Register to maintain an overview of your total orders. There is also the possibility to change your shipping address whenever you'd like to. If you have any open questions about your order, just check out your order number and give us a call.
        </p>
    </div>

    <div>
        <form action="do-sign-up" method="post">

            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>

            <div>
                <label for="email">E-mail Address (will be your username) *</label>
                <input id="email" name="email" placeholder="john.doe@gmail.com" type="email">
            </div>

            <div>
                <label for="firstname">First Name *</label>
                <input id="firstname" name="firstname" placeholder="John" type="text">
            </div>

            <div>
                <label for="lastname">Last Name *</label>
                <input id="lastname" name="lastname" placeholder="Doe" type="text">
            </div>

            <div>
                <label for="address">Address *</label>
                <input id="address" name="address" placeholder="Main Street 24, 2345 Perth, Australia" type="text">
            </div>
            
            <div>
                <label for="password">Password *</label>
                <input id="password" placeholder="*********" type="password" name="password">
            </div>

            <div>
                <label for="password2">Please reapeat password *</label>
                <input id="password2" placeholder="*********" type="password" name="password2">
            </div>

            <p>
                * required
            </p>

            <div>
                <button type="submit">Register!</button>
            </div>
        </form>

        <div>
            <p>
                Already registered?
                <a href="login">
                    Login here!
                </a>
            </p>  
        </div>

    </div>

    <div></div>
</div>
