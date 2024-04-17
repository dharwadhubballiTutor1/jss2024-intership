<!DOCTYPE html>
<html>

<head>
    <title>DharwadHubballiTutor login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel=stylesheet href=https://use.fontawesome.com/releases/v5.0.7/css/all.css />
    <script src="https://kit.fontawesome.com/5482b0b5a4.js" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image:url("/dharwadhubballitutor/Admin/img/login-bg.png");
            background-size: cover; 
        }

        #login #login-box {
            margin-top: 80px;
            max-width: 400px;
            height: 350px;
            border: 1px solid #9C9C9C;
            background-color: #f8c000;
            border-radius: 20px;
        }

        #login #login-box #login-form {
            padding: 20px;
        }

        #login #login-box #login-form #register-link {
            margin-top: 1px;
        }

        .label {
            color: #2a0a5e;
        }

        .btn-warning {
            background-color: #2a0a5e;
            color: #f8c000;
        }

        .btn-warning:hover {
            background-color: #2a0a5e;
            color: #f8c000;
        }

        .card {
            position: relative;
            top: 25%;

        }
    </style>
</head>

<body>
    <div id="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                  
                </div>
                <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <p><i class="fa fa-right-to-bracket"></i> Login</p>
                        </div>
                        <div class="card-body">
                            <form id="login-form" class="form" action="../Controller/login.php" method="post" autocomplete="off">
                                <div class="form-group">
                                    <label for="user_email" class="form-label">User Name</label><br>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                        <input type="text" name="user_email" id="user_email" class="form-control" required>
                                    </div>
                                </div><br>
                                <div class="form-group">
                                    <label for="user_password" class="form-label">Password</label><br>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                    <input type="password" name="user_password" id="user_password" class="form-control" required>
                                    </div>
                                </div><br>
                                <div class="form-group float-end">
                                    
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-right-to-bracket"></i> Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <p><small>DharwadHubballiTutor</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>