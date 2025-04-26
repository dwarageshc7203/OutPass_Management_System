<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert(' Passwords do not match!');</script>";
    } else {
        $check = $conn->prepare("SELECT * FROM users WHERE email = ? OR user_id = ?");
        $check->bind_param("ss", $email, $user_id);
        $check->execute();
        $result = $check->get_result();

        if ($result && $result->num_rows > 0) {
            echo "<script>alert(' Email or Student ID already registered.');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (full_name, user_id, email, phone, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $full_name, $user_id, $email, $phone, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert(' Registration successful!'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert(' Registration failed. Please try again.');</script>";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign-Up | Out Pass Manager</title>
    <!--<link rel="stylesheet" href="signup.css">-->
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


        <style>
            *{
    margin: 0;
}

/*animation*/

@keyframes shake {
    0%   { transform: translateX(0px);}
    20%  { transform: translateX(-10px);}
    40%  { transform: translateX(10px);}
    60%  { transform: translateX(-10px);}
    80%  { transform: translateX(10px);}
    100% { transform: translateX(0px);}
}

@keyframes appear{
    from{
        opacity: 0;
        scale: 0.5;
    }
    to{
        opacity: 1;
        scale: 1;
    }
}

@keyframes slide_left{
    from{
        opacity: 0;
        transform: translateX(-100px);
    }
    to{
        opacity: 1;
        transform: translateX(0px);
    }
}

.shake {
    animation: shake 0.5s ease-in-out;
    background-color: rgba(255, 0, 0, 0.25);
}

#credential{
    animation: slide_left 0.5s ease-in-out;
}

footer{
    animation: appear linear;
    animation-timeline: view();
    animation-range: entry 0 cover 20%;
}

/*animation*/

html {
    scroll-behavior: smooth;
}

a{
    text-decoration: none;
    color: inherit;
}

/*wrapper*/

#wrapper{
    display: flex;
    flex-direction: column;
}

/*wrapper*/

/*header*/

header{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    background-color: #161B22;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    top: 0;
}

#logo{
    display: flex;
    flex-direction: row;
    font-size: 40px;
    font-family: 'Winky Rough', cursive;
    margin: 20px;
    color: rgb(255, 255, 255);
}

#weblogo{
    background: url("https://cdn-icons-png.flaticon.com/512/10799/10799971.png");
    background-size: contain;
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

nav{
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    align-items: flex-end;
    color: white;
    margin: 10px;
}

nav ul{
    display: flex;
    flex-direction: row;
    font-size: 20px;
    font-family: 'Special Gothic Expanded One', cursive;
}

ul li{
    color: #C9D1D9;
    list-style: none;
    padding: 10px;
}

.page:hover{
    scale: 1.2;
    transition: 0.4s ease-in-out;
    background-color: #58A6FF;
    color: #0D1117;
    border-radius: 15px;
}

#contacts{
    cursor: pointer;
}
/*header*/


body{ 
    background-color: #0D1117;
    color: #C9D1D9;
}

/*section*/

section{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 60px;
}

#credential{
    display:flex;
    flex-direction: column;
    align-items: center;
    background-color: #21262D;
    border-radius: 15px;
    width: 800px;
    height: 630px;
}

#login{
    font-family: 'Special Gothic Expanded One', cursive;
    font-size: 50px;
    font-weight: bold;
    margin: 30px;
    margin-bottom: 10px;
}

form{
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.cred{
    display: flex;
    flex-direction: row;
    font-family: 'Lilita One', cursive;
    margin: 15px;
    align-items: center;
    justify-content: flex-start;
    width: 500px;
}

label{
    border-radius: 10px;
    text-align: left;
    align-self: center;
    padding: 10px;
    font-size: 20px;
    width: 200px;
    font-weight: bold;
}

input, select {
    flex: 2;
    padding: 10px;
    border-radius: 10px;
    border: none;
    width: 100%;
    font-size: 16px;
  }

#password_checker{
    display: flex;
    flex-direction: row;
    color: red;
    font-weight: bold;
}

#submit{
    align-self: center;
    font-size: 30px;
    font-weight: bold;
    width: 150px;
    margin: 10px;
    padding: 20px;
    border-radius: 15px;
    cursor: pointer;
    background-color: #238636;
    color: white;
    transition: background-color 0.3s ease-in-out;
}

#submit:hover{
    scale: 1.2;
    transition: 0.4s ease-in-out;
    background-color: rgb(4, 146, 42);
    color: white;
}

#new{
    text-decoration: underline;
    font-family: 'Poetsen One', cursive;
    font-size: 10px;
    align-self: center;
    text-decoration: rgb(51, 51, 169);
    margin: 10px;
}

#new:hover{
    color: rgb(91, 91, 222);
    scale: 1.2;
    transition: 0.3s ease-in-out;
}

/*section-credentials*/

/*footer*/

footer{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgb(46, 53, 62);
    color: white;
    border-radius: 15px;
    margin: 50px;
}

#made_by{
    display: flex;
    flex-direction: row;
    font-size: 40px;
    font-family: 'Pacifico', cursive;

}

.founders{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    font-family: 'Lato',cursive;
}

.links{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    

}

.links img {
    width: 40px; 
    height: auto; 
}

/*footer*/
        </style>

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

        <section>
            <div id="credential">
                <div id="login">SIGN-UP</div>
                <form id="login_form" method="POST" action="">
                            <div class="cred">
                                <label>Enter your Full Name</label>
                                <input type="text" id="username" name="full_name" placeholder="Full Name" required>
                            </div>

                            <div class="cred">
                                <label>Enter your Roll Number / Student ID</label>
                                <input type="text" id="uid" name="user_id" placeholder="Student ID" required>
                            </div>

                            <div class="cred">
                                <label>Enter your Email</label>
                                <input type="email"  name="email" placeholder="Email" required>
                            </div>

                            <div class="cred">
                                <label>Enter your Phone number</label>
                                <input type="text" name="phone" placeholder="Phone Number" required>
                            </div>
                        
                            <div class="cred">
                                <label>Enter Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                            </div>

                            <div class="cred">
                                <label>Confirm Password</label>
                                <input type="password" id="password" name="confirm_password" placeholder="Re-enter Password" required>
                            </div>
                    <button id="submit">Sign-Up</button>
                </form>
            </div>
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
    </div>
</body>
</html>
