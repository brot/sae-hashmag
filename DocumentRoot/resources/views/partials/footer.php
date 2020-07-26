<footer>

    <div>
        <p>
            <strong>
                Want to write?
            </strong>
        </p>
        <a href="mailto:job@hashmag.com">job@hashmag.com</a>
    </div>

    <div>
        <p> 
            <strong>
                Want to talk?
            </strong>
        </p>
        <a href="mailto:hi@hashmag.com">hi@hashmag.com</a>
    </div>

    <?php if (\App\Models\User::isLoggedIn()): ?>

        <div>
        <a href="logout">
            Logout
        </a>
        </div>

    <?php else: ?>

    <div>
        <a href="login">
            Login
        </a>
    </div>
    <?php endif; ?>

    <div>
        <a href="#"> 
            <strong>
                AGB
            </strong>
        </a>
    </div>

    <div>
        <div class="wrapper-some">
            <div>
                <a href="#">
                    <svg width="35" viewBox="0 0 25 25">
                        <path d="M14.4 25V13.6h3.9l.6-4.4h-4.4V6.4c0-1.2.4-2.2 2.2-2.2H19v-4c-.6 0-2-.1-3.5-.1-3.4 0-5.7 2.1-5.7 5.8v3.3H6v4.4h3.9V25h4.5z" fill="#EB5E5E"/>
                    </svg>
                </a>
            </div>

            <div>
                <a href="#">
                    <svg width="35" viewBox="0 0 25 25">
                        <path d="M17.9 0H7.1C3.2 0 0 3.2 0 7.1v10.7c0 4 3.2 7.1 7.1 7.1h10.7c4 0 7.1-3.2 7.1-7.1V7.1c.2-3.9-3.1-7.1-7-7.1zm5.3 17.9c0 2.9-2.4 5.3-5.3 5.3H7.1c-2.9 0-5.3-2.4-5.3-5.3V7.1c0-2.9 2.4-5.3 5.3-5.3h10.8c2.9 0 5.3 2.4 5.3 5.3v10.8z" fill="#EB5E5E"/>
                        <path d="M12.5 6.3c-3.4 0-6.2 2.8-6.2 6.2s2.8 6.2 6.2 6.2 6.2-2.8 6.2-6.2-2.8-6.2-6.2-6.2zm0 10.6c-2.4 0-4.3-1.9-4.3-4.3s2-4.3 4.3-4.3 4.3 1.9 4.3 4.3c.1 2.3-1.9 4.3-4.3 4.3zM19.1 3.8c-.9 0-1.6.7-1.6 1.6 0 .9.7 1.6 1.6 1.6s1.6-.7 1.6-1.6c0-.9-.7-1.6-1.6-1.6z" fill="#EB5E5E"/>
                    </svg>
                </a>
            </div>

            <div> 
                <a href="#">
                    <svg width="35" viewBox="0 0 25 25">
                        <path d="M7.9 22.6c9.4 0 14.6-7.7 14.6-14.6v-.6c1-.7 1.8-1.6 2.5-2.6-1 .4-2 .6-3 .8 1.1-.6 1.8-1.6 2.2-2.8-1 .6-2 1-3.2 1.2-1-1-2.4-1.6-3.8-1.6-2.8.1-5.1 2.3-5.1 5.1-.1.4 0 .7.1 1.1-4-.2-7.8-2.1-10.4-5.4-.4.8-.6 1.7-.6 2.7 0 1.6.8 3.3 2.2 4.2-.8 0-1.7-.2-2.4-.7 0 2.4 1.7 4.5 4.2 5-.4.1-.9.2-1.4.1-.3 0-.7 0-1-.1.7 2.1 2.6 3.6 4.9 3.6-1.8 1.4-4.1 2.2-6.4 2.2-.4 0-.9 0-1.2-.1 2.2 1.7 5 2.6 7.8 2.5" fill="#EB5E5E"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

</footer>

<!-- GreenSock -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.5/gsap.min.js"></script>
<script src="public/js/javascript.js"></script>

</body>
</html>