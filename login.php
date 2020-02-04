<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            margin: 50;
        }

        h1 {
            margin-top: 50px;
            margin-bottom: 50px;
            text-align: center;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <h1>เข้าสู่ระบบ</h1>
    <div class="row">
        <div class="col"></div>

        <div class="col">
            <form action="check_login.php" method="post">
                <div class="form-group">
                    <label for="email">Username</label>
                    <input type="text" class="form-control" name="txt_username">
                </div>
                <div class="form-group">
                    <label for="pwd">Password</label>
                    <input type="password" class="form-control" name="txt_password">
                </div>

                <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
            </form>
        </div>
        <div class="col"></div>
    </div>

</body>

</html>