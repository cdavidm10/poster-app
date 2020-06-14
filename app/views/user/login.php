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
            <h1>Log in</h1>
            <form class="form" id="login-form" method="post" autocomplete="off">
                <div class="alert alert-error"></div>
                <input type="text" value="davi12" placeholder="User Name" name="username" required />
                <input type="password" value="David12-20" placeholder="Password" name="password" required />
                <input type="submit" value="Log in" name="login" class="btn btn-block btn-primary" />
            </form>
            <a href="/"><input type="button" value="Go Back" class="btn btn-block btn-primary" /></a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#login-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '/user/validate',
                    data: $(this).serialize(),
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        console.log(jsonData);

                        // user is logged in successfully in the back-end
                        // let's redirect
                        if (jsonData.success === 1) {
                            alert(jsonData.message);
                            location.href = '/post/';
                        } else {
                            alert(jsonData.message);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>