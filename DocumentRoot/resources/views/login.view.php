<div class="grid-wrapper-headline">

    <h1>Login</h1>
    
</div>

<div class="grid-wrapper">

    <div>
        <p>
            Haven’t signed up for an account yet? Register here to maintain an overview of your total orders and an even more simple and faster checkout. 
        </p>

        <hr>

        <p>
            It covers reviews and interviews with leading designers in the industry, so you can find out more about the experience of cool web designers. It also includes lots of different interviews, interesting research articles, awesome tutorials, great courses, the newest trends, graphic design, and lots more.
        </p>
    </div>

    <div> 
    
        <form class="login_form" action="do-login" method="post">

            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>

            <div>
                <div>
                    <label for="email">E-mail Address</label>
                    <input id="email" type="email" name="email" placeholder="john.doe@gmail.com">
                </div>
            </div> 
            
            <div>
                <div>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="******">
                </div>
            </div> 

            <button type="submit">Login</button>

        </form>

        <div>
            <p>
                No account yet?
                <a href="sign-up">
                    Register here!
                </a>
            </p>  
        </div>

    </div>

    <div></div>

</div>


