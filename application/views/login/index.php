<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../../">
		<meta charset="utf-8" />
		<title>Sign In | Keenthemes</title>
		<meta name="description" content="Singin page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="<?php echo base_url('assets')?>/assets/css/pages/login/login-4.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?php echo base_url('assets')?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets')?>/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets')?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="<?php echo base_url('assets')?>/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets')?>/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets')?>/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets')?>/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<!-- <link rel="shortcut icon" href="<?php echo base_url('assets')?>/assets/media/logos/favicon.ico" /> -->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Content-->
				<div class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
					<!--begin::Wrapper-->
					<div class="login-content d-flex flex-column pt-lg-0 pt-12">
						<!--begin::Logo-->

						
						<!-- <a href="dummyTA/login" class="login-logo pb-xl-20 pb-15">
							<img src="<?=base_url();?>css/assets/img/logo_milagros.png" class="max-h-100px" alt="" />



						</a> -->
						<!--end::Logo-->
						<!--begin::Signin-->
						<div class="login-form">
							<!--begin::Form-->
								<!--begin::Title-->
								<div class="pb-5 pb-lg-15">
									<h1 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Log In</h1>
									<!-- <div class="text-muted font-weight-bold font-size-h4">New Here?
									<a href="custom/pages/login/login-4/signup.html" class="text-primary font-weight-bolder">Create Account</a>
									</div> -->
								</div>


								
								<!--begin::Title-->
								<!--begin::Form group-->
                <form action="<?php echo site_url() ?>login/log_process" method='post'>
                <?php if ($this->session->flashdata('result') != '') { ?>
                        <div class="alert alert-dark alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $this->session->flashdata('result'); ?>
                        </div>
                    <?php
                    }
                ?>
                <div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark">Username</label>
									<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="text" id="user" placeholder="Masukkan username" name="user"autocomplete="off" />
								</div>
                <div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark">Password</label>
									<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="password" id="password" placeholder="Masukkan username" name="password"autocomplete="off" />
								</div>
                
                
								<!--end::Form group-->
								<!--begin::Form group-->
								<!-- <div class="form-group">
									<div class="d-flex justify-content-between mt-n5">
										<label class="font-size-h6 font-weight-bolder text-dark pt-5">Your Name</label>
										<a href="custom/pages/login/login-4/forgot.html" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Forgot Password ?</a>
									</div>
									<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="password" name="password" autocomplete="off" />
								</div> -->
								<!--end::Form group-->
								<!--begin::Action-->
								<div class="pb-lg-0 pb-5">
									<button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Masuk</button>


									<a href="<?php echo base_url('login/forgot') ?>" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 "style="background:red">Lupa Password</a>
									
                </form>
									
								</div>
								<!--end::Action-->
							<!--end::Form-->
						</div>
						<!--end::Signin-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--begin::Content-->
				<!--begin::Aside-->
				<div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right" style="background:purple">
					<div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom" style="background-image: url(<?php echo base_url('assets')?>/assets/media/svg/illustrations/login-visual-4.svg);">
						

				 <!-- <a href="dummyTA/login" class="login-logo pb-xl-20 pb-15">
							<!-- <img src="<?=base_url();?>css/assets/img/logo_milagros.png" class="max-h-100px" alt="" /> --> --> -->

						<!--begin::Aside title -->
						<h3 class="pt-lg-40 pl-lg-20 pb-lg-0 pl-10 py-20 m-0 d-flex justify-content-lg-start font-weight-boldest display5 display1-lg text-white">Milagros
						<br />Miracle 
						<br />Inside</h3>
						<!--end::Aside title-->
					</div>
				</div>
				<!--end::Aside-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?php echo base_url('assets')?>/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url('assets')?>/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="<?php echo base_url('assets')?>/assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?php echo base_url('assets')?>/assets/js/pages/custom/login/login-4.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>