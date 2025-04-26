<!doctype html>
<html>
    <head>
        <meta charset="utf8">
        <link rel="stylesheet" href="homepage.css">
        <title>Outpass Management Website</title>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/10799/10799971.png">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Winky+Rough:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    </head>
    <body>
        <div id="wrapper">
        <header>
            <div id="logo">
                <div id="weblogo"></div>OUT PASS MANAGER</div>
            <nav>
                <ul>
                    <li class="page"><a href="homepage.php">Home</a></li>
                    <li class="page"><a href="signup.php">Sign-Up</a></li>
                    <li class="page"><a href="login.php">Login</a></li>
                    <li class="page" id="contacts">Contacts</li>
                </ul>
            </nav>
        </header>

        <section id="hero">
            <div id="bio">Get your outpass, quicker and better</div>
            <div id="picture"></div>
        </section>

        <section id="content">
            <div class="feature_pics">
                <img src="Updates.png">
                <div class="feature">Get updates regarding next holidays and events</div>
            </div>
            <div class="feature_pics">
                <img src="Fast.png">
                <div class="feature">Get outpass more faster than ever</div>
            </div>
            <div class="feature_pics">
                <img src="Support.png">
                <div class="feature">Better response and communication</div>
            </div>
        </section>

        <section id="start">
            <button id="start_now" onclick="redirect_login()">START NOW</button>
        </section>

        <section id="tools">
            <div class="left">Why delay your outings 'coz you don't have your outpass yet?</div>
            <div class="right">Get your outpass as soon as you apply!</div>
            <div class="left">Quick verification and easy assist</div>
            <div class="right">Better UI and control for wardens!</div>
        </section>

        <footer>
            <div id="made_by">Crafted by</div>
            <div class="founders">DWARAGESH C
                <ul class="links">
                    <li><a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSDbhCLBLxqwZgxzLwDDrrTwMZdmjHKRJfxNFlBZMtrvRCFTMjvbqCQNbfvSRxKtbpSXvwxG">
                        <img src="https://freepngimg.com/download/gmail/66428-icons-computer-google-email-gmail-free-transparent-image-hq.png">
                        </a></li>
                    <li><a href="https://github.com/dwarageshc7203">
                        <img src="https://pngimg.com/uploads/github/github_PNG80.png">
                        </a></li>
                    <li><a href="https://www.linkedin.com/in/dwarageshc/">
                        <img src="https://itcnet.gr/wp-content/uploads/2020/09/Linkedin-logo-on-transparent-Background-PNG--1024x1024.png">
                        </a></li>
                </ul>
            </div>

            <div class="founders">SRIDEV B
                <ul class="links">
                    <li><a href="https://mail.google.com/mail/u/0/#inbox?compose=new">
                        <img src="https://freepngimg.com/download/gmail/66428-icons-computer-google-email-gmail-free-transparent-image-hq.png">
                        </a></li>
                    <li><a href="https://github.com/SRIDEV20">
                        <img src="https://pngimg.com/uploads/github/github_PNG80.png">
                        </a></li>
                    <li><a href="https://www.linkedin.com/in/sri-dev-58aa4434a/">
                        <img src="https://itcnet.gr/wp-content/uploads/2020/09/Linkedin-logo-on-transparent-Background-PNG--1024x1024.png">
                        </a></li>
                </ul>
            </div>
        </footer>
        <script src="homepage.js"></script>

    </div>    
    </body>
</html>
