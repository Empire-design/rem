<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <div class="login-page">
        <div class="container d-flex align-items-center">
            @include('admin.sessionMessaage')
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
                    <!-- Form Panel-->
                    <div class="col-lg-6 bg-white">
                        <div class="form d-flex align-items-center">
                            <div class="content">
                                <form class="text-left form-validate" action="{{ url('insertregister') }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group-material">
                                        <input id="register-username" type="text" name="username" required
                                            data-msg="Please enter your username" class="input-material">
                                        <label for="register-username" class="label-material">Username</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="register-email" type="email" name="email" required
                                            data-msg="Please enter a valid email address" class="input-material">
                                        <label for="register-email" class="label-material">Email Address </label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="register-password" type="password" name="password" required
                                            data-msg="Please enter your password" class="input-material">
                                        <label for="register-password" class="label-material">Password </label>
                                    </div>
                                    <div class="form-group terms-conditions text-center">
                                        <input id="register-agree" name="agree" type="checkbox" required
                                            value="1" data-msg="Your agreement is required"
                                            class="checkbox-template">
                                        <label for="register-agree">I agree with the terms and policy</label>
                                    </div>
                                    <div class="form-group text-center">
                                        <input id="register" type="submit" value="Register" class="btn btn-primary">
                                    </div>
                                </form><small>Already have an account? </small><a href="{{ url('addlogin') }}"
                                    class="signup">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates
                    Hub</a>
            </p>
        </div>
    </div>
    <!-- JavaScript files-->
    {{-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script> --}}
    @include('admin.js')
</body>

</html>
