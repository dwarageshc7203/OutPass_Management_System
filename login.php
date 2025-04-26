<?php
session_start();
include('db_connect.php');

$emailRegex = "/^[a-zA-Z0-9_@.]{3,50}$/";
$idRegex = "/^[0-9]{6,15}$/";
$passwordRegex = "/^[a-zA-Z0-9!@#$%^&*]{6,20}$/";

$email = $id = $password = $role = "";
$emailErr = $idErr = $passwordErr = $roleErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $id = $_POST['id'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!preg_match($emailRegex, $email)) {
        $emailErr = "Invalid email.";
    }

    if (!preg_match($idRegex, $id)) {
        $idErr = "Invalid ID.";
    }

    if (!preg_match($passwordRegex, $password)) {
        $passwordErr = "Invalid password.";
    }

    if (empty($role)) {
        $roleErr = "Please select a role.";
    }

    if (empty($emailErr) && empty($idErr) && empty($passwordErr) && empty($roleErr)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND user_id = ?");
        $stmt->bind_param("ss", $email, $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['full_name'];
                $_SESSION['role'] = $role;
                $_SESSION['user_id'] = $user['user_id'];
                header("Location: student_dashboard.php");
                exit();
            } else {
                echo "<script>alert(' Incorrect password.');</script>";
            }
        } else {
            echo "<script>alert(' No matching user found.');</script>";
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/10799/10799971.png">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Lilita+One&family=Special+Gothic+Expanded+One&family=Winky+Rough:wght@400&family=Pacifico&family=Lato:wght@400&display=swap" rel="stylesheet">

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
    <style>*{
    margin: 0;
}

/*animations*/

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

footer{
    animation: appear linear;
    animation-timeline: view();
    animation-range: entry 0 cover 20%;
}

#credential{
    animation: slide_left 0.5s ease-in-out;
}

/*animations*/

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
    height: 550px;
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

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("contacts").addEventListener("click", () => {
                document.querySelector("footer").scrollIntoView({ behavior: "smooth" });
            });

            document.getElementById("login_form").addEventListener("submit", function (e) {
                const email = document.querySelector('input[name="email"]').value.trim();
                const id = document.getElementById("uid").value.trim();
                const password = document.getElementById("password").value.trim();
                const role = document.querySelector('select[name="role"]').value;

                if (!(email && id && password && role)) {
                    e.preventDefault();
                    alert("Fill in all the details.");
                }
            });
        });
    </script>
</head>
<body>
    <div id="wrapper">
        <header>
            <div id="logo"><div id="weblogo"></div>
            OUTPASS MANAGER</div>
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
                <div id="login">LOGIN</div>
                <form id="login_form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="cred">
                        <label>Enter your Email</label>
                        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>
                    <div class="cred">
                        <label>Enter your Roll Number / Student ID</label>
                        <input type="text" name="id" id="uid" placeholder="ID" value="<?php echo htmlspecialchars($id); ?>" required>
                        <span class="error"><?php echo $idErr; ?></span>
                    </div>
                    <div class="cred">
                        <label>Enter password</label>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <span class="error"><?php echo $passwordErr; ?></span>
                    </div>
                    <div class="cred">
                        <label>Select your role</label>
                        <select name="role" required>
                            <option value="" disabled hidden selected>Role</option>
                            <option value="student" <?php echo ($role == "student") ? "selected" : ""; ?>>Student</option>
                            <option value="warden" <?php echo ($role == "warden") ? "selected" : ""; ?>>Warden</option>
                            <option value="parent" <?php echo ($role == "parent") ? "selected" : ""; ?>>Parent</option>
                        </select>
                        <span class="error"><?php echo $roleErr; ?></span>
                    </div>
                    <button id="submit" type="submit">Login</button>
                    <div id="new"><a href="signup.html">New user? Sign-Up here!</a></div>
                </form>
            </div>
        </section>

        <footer>
            <div id="made_by">Crafted by</div>
            <div class="founders">DWARAGESH C
                <ul class="links">
                    <li><a href="#"><img src="https://freepngimg.com/download/gmail/66428-icons-computer-google-email-gmail-free-transparent-image-hq.png"></a></li>
                    <li><a href="https://github.com/dwarageshc7203"><img src="https://pngimg.com/uploads/github/github_PNG80.png"></a></li>
                    <li><a href="https://www.linkedin.com/in/dwarageshc/"><img src="https://itcnet.gr/wp-content/uploads/2020/09/Linkedin-logo-on-transparent-Background-PNG--1024x1024.png"></a></li>
                </ul>
            </div>
            <div class="founders">SRIDEV B
                <ul class="links">
                    <li><a href="#"><img src="https://freepngimg.com/download/gmail/66428-icons-computer-google-email-gmail-free-transparent-image-hq.png"></a></li>
                    <li><a href="https://github.com/SRIDEV20"><img src="https://pngimg.com/uploads/github/github_PNG80.png"></a></li>
                    <li><a href="https://www.linkedin.com/in/sri-dev-58aa4434a/"><img src="https://itcnet.gr/wp-content/uploads/2020/09/Linkedin-logo-on-transparent-Background-PNG--1024x1024.png"></a></li>
                </ul>
            </div>
        </footer>
    </div>
</body>
</html>