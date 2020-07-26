<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>hash magazin | graphic design</title>
    <base href="<?php echo \Core\Helpers\Config::get('app.baseUrl'); ?>">
    <link rel="stylesheet" href="public/css/style.css"/>
    <link rel="stylesheet" href="https://use.typekit.net/pho4mqo.css">
</head>

<body>

<header>

    <div class="js_navbar">
        <nav>

            <div class="wrapper_nav">

                <ol class="menu_points">

                    <li class="hash_logo">
                        <a href="home">
                            <span class="visually-hidden">hash Homepage</span>
                            <p>#</p>                  
                        </a>
                    </li>

                    <li>
                        <a href="products" class="current">
                            Magazines
                        </a>
                    </li>

                    <?php if (\App\Models\User::isLoggedIn()): ?>

                        <li>
                            <a href="logout">
                                Logout
                            </a>
                        </li> 

                    <?php if (\App\Models\User::getLoggedInUser()->is_admin === true): ?>
                        
                        <li>
                            <a href="dashboard">Dashboard</a>
                        </li>

                        <li>
                            <a href="dashboard/accounts">Edit accounts</a>
                        </li>

                    <?php endif; ?>

                    <li>
                        <a href="account" class="nav-link">Account (<?php echo \App\Models\User::getLoggedInUser()->email; ?>)</a>
                    </li>  

                    <?php else: ?>

                        <li>
                            <a href="sign-up">
                                Register
                            </a>
                        </li>

                        <li>
                            <a href="login">
                                Login
                            </a>
                        </li>

                    <?php endif; ?>

                    <li>
                        <a href="cart">
                            Cart
                            <span class="totalProducts">
                                <?php echo App\Models\Cart::totalProducts(); ?>
                            </span>
                        </a>
                    </li>

                </ol>
            </div>
        </nav>  
    </div>

    <div class="j-sticky-nav"></div>
</header>


