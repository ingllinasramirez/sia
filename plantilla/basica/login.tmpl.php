{% extends "basica/base.tmpl.php" %}
{% block titulo %}Bienvenidos al SIA-GROP{% endblock %}
{% block estilos %}
<link rel="apple-touch-icon" href="plantilla/basica/app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="plantilla/basica/app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
rel="stylesheet">
<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="plantilla/basica/app-assets/css/vendors.css">
<link rel="stylesheet" type="text/css" href="plantilla/basica/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="plantilla/basica/app-assets/vendors/css/forms/icheck/custom.css">
<!-- END VENDOR CSS-->
<!-- BEGIN MODERN CSS-->
<link rel="stylesheet" type="text/css" href="plantilla/basica/app-assets/css/app.css">
<!-- END MODERN CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="plantilla/basica/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
<link rel="stylesheet" type="text/css" href="plantilla/basica/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="plantilla/basica/app-assets/css/pages/login-register.css">
<!-- END Page Level CSS-->
<!-- BEGIN Custom CSS-->
<link rel="stylesheet" type="text/css" href="plantilla/basica/assets/css/style.css">
{% endblock %}
{% block estilos_body %}class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column"{% endblock %}
{% block area_principal %}
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="plantilla/basica/app-assets/images/logo/logo-dark.png" alt="branding logo">
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Easily Using</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="text-center">
                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook">
                      <span class="la la-facebook"></span>
                    </a>
                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter">
                      <span class="la la-twitter"></span>
                    </a>
                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin">
                      <span class="la la-linkedin font-medium-4"></span>
                    </a>
                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github">
                      <span class="la la-github font-medium-4"></span>
                    </a>
                  </div>
                  <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                    <span>OR Using Account Details</span>
                  </p>
                  <div class="card-body">
                    <form class="form-horizontal" action="index.html" novalidate>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" id="user-name" placeholder="Your Username"
                        required>
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" id="user-password" placeholder="Enter Password"
                        required>
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-sm-left">
                          <fieldset>
                            <input type="checkbox" id="remember-me" class="chk-remember">
                            <label for="remember-me"> Remember Me</label>
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                      </div>
                      <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
                    </form>
                  </div>
                  <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                    <span>New to Modern ?</span>
                  </p>
                  <div class="card-body">
                    <a href="register-with-bg-image.html" class="btn btn-outline-danger btn-block"><i class="ft-user"></i> Register</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
{% endblock %}
{% block piecera %}
<footer class="footer fixed-bottom footer-dark navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright © 2018 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT </a>, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted &amp; Made with <i class="ft-heart pink"></i></span>
    </p>
</footer>
{% endblock %}
{% block script_finales %}
<script src="plantilla/basica/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="plantilla/basica/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="plantilla/basica/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="plantilla/basica/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="plantilla/basica/app-assets/js/core/app.js" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="plantilla/basica/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
{% endblock %}