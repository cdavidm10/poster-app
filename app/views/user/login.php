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
            <form class="form" action="form.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="alert alert-error"></div>
                <input type="text" placeholder="User Name" name="username" required />
                <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
                <input type="submit" value="Log in" name="login" class="btn btn-block btn-primary" />
            </form>
            <a href="/"><input type="button" value="Go Back" class="btn btn-block btn-primary" /></a>
        </div>
    </div>
</body>

</html>