<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    <div class="login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
                <div class="row">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6">
                        <div class="info d-flex align-items-center">
                            <div class="content">
                                <div class="logo">
                                    <h1>Dashboard</h1>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Form Panel    -->
                    <div class="col-lg-6 bg-white">
                        <div class="form d-flex align-items-center">
                            <div class="content">
                                <form method="get" class="form-validate">
                                    <div class="form-group">
                                        <input id="login-username" type="text" name="loginUsername" required
                                            data-msg="Please enter your username" class="input-material">
                                        <label for="login-username" class="label-material">User Name</label>
                                    </div>
                                    <div class="form-group">
                                        <input id="login-password" type="password" name="loginPassword" required
                                            data-msg="Please enter your password" class="input-material">
                                        <label for="login-password" class="label-material">Password</label>
                                    </div><a id="login" href="index.html" class="btn btn-primary">Login</a>
                                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                                </form><a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have
                                    an account? </small><a href="{{ url('addregister') }}" class="signup">Signup</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates
                    Hub</a>.</p>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
</body>

</html>
