<!DOCTYPE html>
<html lang="en">

<head>
    <title>Poster App </title>
    <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/app.css" type="text/css">
</head>

<body>
    <h1>Poster App - Test</h1>
    <div class="body-content">
        <div class="module">
            <h1>Create Account</h1>
            <form class="form" id="register-form" method="post" autocomplete="off">
                <div class="alert alert-error"></div>
                <input required type="text" placeholder="User Name" name="username" minlength="6" maxlength="20" pattern="^[a-zA-Z]{4,}[\d]{2,}$" title="Username should have at least 4 letters and 2 numbers, and should not contain special characters.. e.g. david02" />
                <input type="text" placeholder="Phone" name="phone" required pattern="\d{10,20}$" title="Phone must have at least 10 numbers" minlength="10" maxlength="20" />
                <input type="email" placeholder="Email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be a valid email example@email.com" />
                <input type="password" placeholder="Password" name="password" required pattern="(?=.*\d)(?=.*[-])(?=.*[A-Z]){6,20}" minlength="6" maxlength="20" title="Password should be at least 6 characters long and contain a “-” and an uppercase letter." />
                <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
            </form>
            <a href="/user/login"><input type="button" value="Log in" class="btn btn-block btn-primary" /></a>
            <a href="/"><input type="button" value="Go Back" class="btn btn-block btn-primary" /></a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(function() {
            $('#register-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '/user/create',
                    data: $(this).serialize(),
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        alert(jsonData.message);

                        // user was created successfully in the back-end
                        // let's redirect
                        if (jsonData.success === 1) {
                            location.href = '/post/';
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>