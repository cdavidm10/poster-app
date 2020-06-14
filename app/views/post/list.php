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
            <div class="posts-list">
                <h1>Recently Posts</h1>
                <?php
                echo "Posts from: ";
                var_dump($data);
                ?>
            </div>
            &nbsp;
            <hr />
            &nbsp;
            <form class="form" id="new-post" method="post" autocomplete="off">
                <textarea name="message" placeholder="Write something here" required></textarea>
                <input type="submit" value="Write a comment" class="btn btn-block btn-primary" />
            </form>
            <a href="/user/logout"><input type="button" value="Log out" class="btn btn-block btn-primary" /></a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#new-post').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '/post/create',
                    data: $(this).serialize(),
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        alert(jsonData.message);

                        // Post was created successfully in the back-end
                        // let's redirect
                        if (jsonData.success === 1) {
                            location.href = '/post/index';
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>