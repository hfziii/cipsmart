<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title> Login - Cipsmart</title>
    <link rel="stylesheet" href="./css/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="img/favicon/android-chrome-192x192.png" type="image/png">
</head>

<body>
    <div class="container">

        <div class="center">
            <img src="./img/login/logo-cipsmart-profile.png" alt="Logo" class="logo">

            <!-- CONTAINER FORM LOGIN -->
            <div class="formlogin">
                <div class="switch-button">
                    <button id="loginBtn" class="active" onclick="showLogin()">Login Admin</button>
                    <!-- <button id="signupBtn" onclick="showSignup()">Sign up</button> -->
                </div>

                <div class="form-container">

                    <!-- LOGIN -->
                    <form action="ceklogin.php" method="post" id="loginForm" class="form visible form-log">

                        <!-- FORM USERNAME PASSWORD -->
                        <div class="input-container">
                            <i class="fa fa-user"></i>
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="input-container password-container">
                            <i class="fa fa-lock"></i>
                            <input type="password" id="loginPassword" class="input-pw" name="password"
                                placeholder="Password" required>
                            <span class="toggle-password" onclick="togglePassword()">
                                <i class="fa fa-eye-slash" id="togglePasswordIcon"></i>
                            </span>
                        </div>

                        <!-- CHECKBOX -->
                        <label for="termsCheckbox" class="termsCheckbox">
                            <input type="checkbox" class="termsCheckbox" name="termsCheckbox">
                            Remember me?
                        </label>

                        <!-- BUTTON SUBMIT -->
                        <button type="submit" class="btn-login">Log in</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
    <script src="./js/login.js"></script>
</body>

</html>