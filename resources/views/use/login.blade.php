@extends('layouts/contentLayoutMaster')

@section('title', 'Form Layouts')

@section('content')
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template"><script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-5J3LMKC"></script><script id="allow-copy_script">(function agent() {
    let unlock = false
    document.addEventListener('allow_copy', (event) => {
      unlock = event.detail.unlock
    })

    const copyEvents = [
      'copy',
      'cut',
      'contextmenu',
      'selectstart',
      'mousedown',
      'mouseup',
      'mousemove',
      'keydown',
      'keypress',
      'keyup',
    ]
    const rejectOtherHandlers = (e) => {
      if (unlock) {
        e.stopPropagation()
        if (e.stopImmediatePropagation) e.stopImmediatePropagation()
      }
    }
    copyEvents.forEach((evt) => {
      document.documentElement.addEventListener(evt, rejectOtherHandlers, {
        capture: true,
      })
    })
  })()</script><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Login Cover - Pages | Vuexy - Bootstrap Admin Template</title>

    
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5">
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">
    
    
    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5J3LMKC');</script>
    <!-- End Google Tag Manager -->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css">
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css">
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css">

    <!-- Core CSS -->
    
    
    <link rel="stylesheet" href="../../assets/css/demo.css">
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css">
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css"> 
    <!-- Vendor -->
<link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/umd/styles/index.min.css">

    <!-- Page CSS -->
    <!-- Page -->
<link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css">

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script><link href="chrome-extension://lnkdbjbjpnpjeciipoaflmpcddinpjjp/mytube.css" rel="stylesheet" type="text/css"><style type="text/css">
.layout-menu-fixed .layout-navbar-full .layout-menu,
.layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {
  top: 0px !important;
}
.layout-page {
  padding-top: 0px !important;
}
.content-wrapper {
  padding-bottom: 0px !important;
}</style>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script><style>#template-customizer{font-family:"Public Sans",BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol" !important;font-size:inherit !important;position:fixed;top:0;right:0;height:100%;z-index:99999999;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;width:400px;background:#fff;-webkit-box-shadow:0 0 20px 0 rgba(0,0,0,.2);box-shadow:0 0 20px 0 rgba(0,0,0,.2);-webkit-transition:all .2s ease-in;-o-transition:all .2s ease-in;transition:all .2s ease-in;-webkit-transform:translateX(420px);-ms-transform:translateX(420px);transform:translateX(420px)}#template-customizer h5{position:relative;font-size:11px}#template-customizer>h5{flex:0 0 auto}#template-customizer .disabled{color:#d1d2d3 !important}#template-customizer .form-label{font-size:.9375rem}#template-customizer .form-check-label{font-size:.8125rem}#template-customizer .template-customizer-t-panel_header{font-size:1.125rem}#template-customizer.template-customizer-open{-webkit-transition-delay:.1s;-o-transition-delay:.1s;transition-delay:.1s;-webkit-transform:none !important;-ms-transform:none !important;transform:none !important}#template-customizer.template-customizer-open .custom-option.checked{color:var(--bs-primary);border-width:2px}#template-customizer.template-customizer-open .custom-option.checked .custom-option-content{border:none}#template-customizer.template-customizer-open .custom-option .custom-option-content{border:1px solid rgba(0,0,0,0)}#template-customizer .template-customizer-header a:hover{color:inherit !important}#template-customizer .template-customizer-open-btn{position:absolute;top:180px;left:0;z-index:-1;display:block;width:42px;height:42px;border-top-left-radius:15%;border-bottom-left-radius:15%;background:var(--bs-primary);color:#fff !important;text-align:center;font-size:18px !important;line-height:42px;opacity:1;-webkit-transition:all .1s linear .2s;-o-transition:all .1s linear .2s;transition:all .1s linear .2s;-webkit-transform:translateX(-62px);-ms-transform:translateX(-62px);transform:translateX(-62px)}@media(max-width: 991.98px){#template-customizer .template-customizer-open-btn{top:145px}}.dark-style #template-customizer .template-customizer-open-btn{background:var(--bs-primary)}#template-customizer .template-customizer-open-btn::before{content:"";width:22px;height:22px;display:block;background-size:100% 100%;position:absolute;background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAABClJREFUaEPtmY1RFEEQhbsjUCIQIhAiUCNQIxAiECIQIxAiECIAIpAMhAiECIQI2vquZqnZvp6fhb3SK5mqq6Ju92b69bzXf6is+dI1t1+eAfztG5z1BsxsU0S+ici2iPB3vm5E5EpEDlSVv2dZswFIxv8UkZcNy+5EZGcuEHMCOBeR951uvVDVD53vVl+bE8DvDu8Pxtyo6ta/BsByg1R15Bwzqz5/LJgn34CZwfnPInI4BUB6/1hV0cSjVxcAM4PbcBZjL0XklIPN7Is3fLCkdQPpPYw/VNXj5IhPIvJWRIhSl6p60ULWBGBm30Vk123EwRxCuIzWkkjNrCZywith10ewE1Xdq4GoAjCz/RTXW44Ynt+LyBEfT43kYfbj86J3w5Q32DNcRQDpwF+dkQXDMey8xem0L3TEqB4g3PZWad8agBMRgZPeu96D1/C2Zbh3X0p80Op1xxloztN48bMQQNoc7+eLEuAoPSPiIDY4Ooo+E6ixeNXM+D3GERz2U3CIqMstLJUgJQDe+7eq6mub0NYEkLAKwEHkiBQDCZtddZCZ8d6r7JDwFkoARklHRPZUFVDVZWbwGuNrC4EfdOzFrRABh3Wnqhv+d70AEBLGFROPmeHlnM81G69UdSd6IUuM0GgUVn1uqWmg5EmMfBeEyB7Pe3txBkY+rGT8j0J+WXq/BgDkUCaqLgEAnwcRog0veMIqFAAwCy2wnw+bI2GaGboBgF9k5N0o0rUSGUb4eO0BeO9j/GYhkSHMHMTIqwGARX6p6a+nlPBl8kZuXMD9j6pKfF9aZuaFOdJCEL5D4eYb9wCYVCanrBmGyii/tIq+SLj/HQBCaM5bLzwfPqdQ6FpVHyra4IbuVbXaY7dETC2ESPNNWiIOi69CcdgSMXsh4tNSUiklMgwmC0aNd08Y5WAES6HHehM4gu97wyhBgWpgqXsrASglprDy7CwhehMZOSbK6JMSma+Fio1KltCmlBIj7gfZOGx8ppQSXrhzFnOhJ/31BDkjFHRvOd09x0mRBA9SFgxUgHpQg0q0t5ymPMlL+EnldFTfDA0NAmf+OTQ0X0sRouf7NNkYGhrOYNrxtIaGg83MNzVDSe3LXLhP7O/yrCsCz1zlWTpjWkuZAOBpX3yVnLqI1yLCOKU6qMrmP7SSrUEw54XF4WBIK5FxCMOr3lVsfGqNSmPzBXUnJTIX1jyVBq9wO6UObOpgC5GjO98vFKnTdQMZXxEsWZlDiCZMIxAbNxQOqlpVZtobejBaZNoBnRDzMFpkxvTQOD36BlrcySZuI6p1ACB6LU3wWuf5581+oHfD1vi89bz3nFUC8Nm7ZlP3nKkFbM4bWPt/MSFwklprYItwt6cmvpWJ2IVcQBCz6bLysSCv3SaANCiTsnaNRrNRqMXVVT1/BrAqz/buu/Y38Ad3KC5PARej0QAAAABJRU5ErkJggg==);margin:10px}.customizer-hide #template-customizer .template-customizer-open-btn{display:none}[dir=rtl] #template-customizer .template-customizer-open-btn{border-radius:0;border-top-right-radius:15%;border-bottom-right-radius:15%}[dir=rtl] #template-customizer .template-customizer-open-btn::before{margin-left:-2px}#template-customizer.template-customizer-open .template-customizer-open-btn{opacity:0;-webkit-transition-delay:0s;-o-transition-delay:0s;transition-delay:0s;-webkit-transform:none !important;-ms-transform:none !important;transform:none !important}#template-customizer .template-customizer-inner{position:relative;overflow:auto;-webkit-box-flex:0;-ms-flex:0 1 auto;flex:0 1 auto;opacity:1;-webkit-transition:opacity .2s;-o-transition:opacity .2s;transition:opacity .2s}#template-customizer .template-customizer-inner>div:first-child>hr:first-of-type{display:none !important}#template-customizer .template-customizer-inner>div:first-child>h5:first-of-type{padding-top:0 !important}#template-customizer .template-customizer-themes-inner{position:relative;opacity:1;-webkit-transition:opacity .2s;-o-transition:opacity .2s;transition:opacity .2s}#template-customizer .template-customizer-theme-item{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;align-items:center;-ms-flex-align:center;-webkit-box-flex:1;-ms-flex:1 1 100%;flex:1 1 100%;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;margin-bottom:10px;padding:0 24px;width:100%;cursor:pointer}#template-customizer .template-customizer-theme-item input{position:absolute;z-index:-1;opacity:0}#template-customizer .template-customizer-theme-item input~span{opacity:.25;-webkit-transition:all .2s;-o-transition:all .2s;transition:all .2s}#template-customizer .template-customizer-theme-item .template-customizer-theme-checkmark{display:inline-block;width:6px;height:12px;border-right:1px solid;border-bottom:1px solid;opacity:0;-webkit-transition:all .2s;-o-transition:all .2s;transition:all .2s;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}[dir=rtl] #template-customizer .template-customizer-theme-item .template-customizer-theme-checkmark{border-right:none;border-left:1px solid;-webkit-transform:rotate(-45deg);-ms-transform:rotate(-45deg);transform:rotate(-45deg)}#template-customizer .template-customizer-theme-item input:checked:not([disabled])~span,#template-customizer .template-customizer-theme-item:hover input:not([disabled])~span{opacity:1}#template-customizer .template-customizer-theme-item input:checked:not([disabled])~span .template-customizer-theme-checkmark{opacity:1}#template-customizer .template-customizer-theme-colors span{display:block;margin:0 1px;width:10px;height:10px;border-radius:50%;-webkit-box-shadow:0 0 0 1px rgba(0,0,0,.1) inset;box-shadow:0 0 0 1px rgba(0,0,0,.1) inset}#template-customizer.template-customizer-loading .template-customizer-inner,#template-customizer.template-customizer-loading-theme .template-customizer-themes-inner{opacity:.2}#template-customizer.template-customizer-loading .template-customizer-inner::after,#template-customizer.template-customizer-loading-theme .template-customizer-themes-inner::after{content:"";position:absolute;top:0;right:0;bottom:0;left:0;z-index:999;display:block}@media(max-width: 1200px){#template-customizer{display:none;visibility:hidden !important}}@media(max-width: 575.98px){#template-customizer{width:300px;-webkit-transform:translateX(320px);-ms-transform:translateX(320px);transform:translateX(320px)}}.layout-menu-100vh #template-customizer{height:100vh}[dir=rtl] #template-customizer{right:auto;left:0;-webkit-transform:translateX(-420px);-ms-transform:translateX(-420px);transform:translateX(-420px)}[dir=rtl] #template-customizer .template-customizer-open-btn{right:0;left:auto;-webkit-transform:translateX(62px);-ms-transform:translateX(62px);transform:translateX(62px)}[dir=rtl] #template-customizer .template-customizer-close-btn{right:auto;left:0}#template-customizer .template-customizer-layouts-options[disabled]{opacity:.5;pointer-events:none}[dir=rtl] .template-customizer-t-style_switch_light{padding-right:0 !important}</style>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script><link rel="stylesheet" type="text/css" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css"><link rel="stylesheet" type="text/css" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css">
    
<script src="chrome-extension://lnkdbjbjpnpjeciipoaflmpcddinpjjp/mutationObserver.js"></script><script src="chrome-extension://lnkdbjbjpnpjeciipoaflmpcddinpjjp/mytube.js"></script><style>
 div#captureUI.disable{ 
 color:black; 
 background:url("chrome-extension://kjdgohfkopafhjmmlbojhaabfpndllgk/images/capture_disable.png") no-repeat center; 
 opacity:0.7; 
 } 
 div#captureUI.enable{ 
 color:white; 
 background:url("chrome-extension://kjdgohfkopafhjmmlbojhaabfpndllgk/images/capture_enable.png") no-repeat center; 
 opacity:1.0; 
  }  
 div#captureUI.enable:hover{ 
 /* background:url("chrome-extension://kjdgohfkopafhjmmlbojhaabfpndllgk/images/capture_hover.png") no-repeat center; */ 
 opacity:0.9; 
 }
  div#captureUI.disable:hover{ 
  /* background:url("chrome-extension://kjdgohfkopafhjmmlbojhaabfpndllgk/images/capture_hover.png") no-repeat center;*/  opacity:1.0; 
}</style></head>

<body class="vsc-initialized">

  
  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  
  <!-- Content -->

<div class="authentication-wrapper authentication-cover authentication-bg">
  <div class="authentication-inner row">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="../../assets/img/illustrations/auth-login-illustration-light.png" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png">

        <img src="../../assets/img/illustrations/bg-shape-image-light.png" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="index.html" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0"></path>
  <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
  <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0"></path>
</svg>
</span>
          </a>
        </div>
        <!-- /Logo -->
        <h3 class="mb-1">Welcome to Vuexy! 👋</h3>
        <p class="mb-4">Please sign-in to your account and start the adventure</p>

        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework" action="index.html" method="POST" novalidate="novalidate">
          <div class="mb-3 fv-plugins-icon-container">
            <label for="email" class="form-label">Email or Username</label>
            <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus="">
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
          <div class="mb-3 form-password-toggle fv-plugins-icon-container">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Password</label>
              <a href="auth-forgot-password-cover.html">
                <small>Forgot Password?</small>
              </a>
            </div>
            <div class="input-group input-group-merge has-validation">
              <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember-me">
              <label class="form-check-label" for="remember-me">
                Remember Me
              </label>
            </div>
          </div>
          <button class="btn btn-primary d-grid w-100 waves-effect waves-light">
            Sign in
          </button>
        <input type="hidden"></form>

        <p class="text-center">
          <span>New on our platform?</span>
          <a href="auth-register-cover.html">
            <span>Create an account</span>
          </a>
        </p>

        <div class="divider my-4">
          <div class="divider-text">or</div>
        </div>

        <div class="d-flex justify-content-center">
          <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3 waves-effect">
            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3 waves-effect">
            <i class="tf-icons fa-brands fa-google fs-5"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-label-twitter waves-effect">
            <i class="tf-icons fa-brands fa-twitter fs-5"></i>
          </a>
        </div>
      </div>
    </div>
    <!-- /Login -->
  </div>
</div>

<!-- / Content -->

  
  <div class="buy-now">
    <a href="https://1.envato.market/vuexy_admin" target="_blank" class="btn btn-danger btn-buy-now waves-effect waves-light">Buy Now</a>
  </div>
  

  

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  
  <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../../assets/vendor/libs/popper/popper.js"></script>
  <script src="../../assets/vendor/js/bootstrap.js"></script>
  <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
  <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
  <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
   <script src="../../assets/vendor/js/menu.js"></script>
  
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="../../assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
<script src="../../assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
<script src="../../assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

  <!-- Main JS -->
  <script src="../../assets/js/main.js"></script>
  

  <!-- Page JS -->
  <script src="../../assets/js/pages-auth.js"></script>
  






<mytubeelement id="myTubeRelayElementToPage" event="preferencesUpdated" data="{&quot;bundle&quot;:{&quot;label_delimitor&quot;:&quot;:&quot;,&quot;percentage&quot;:&quot;%&quot;,&quot;smart_buffer&quot;:&quot;Smart Buffer&quot;,&quot;start_playing_when_buffered&quot;:&quot;Start playing when buffered&quot;,&quot;sound&quot;:&quot;Sound&quot;,&quot;desktop_notification&quot;:&quot;Desktop Notification&quot;,&quot;continuation_on_next_line&quot;:&quot;-&quot;,&quot;loop&quot;:&quot;Loop&quot;,&quot;only_notify&quot;:&quot;Only Notify&quot;,&quot;estimated_time&quot;:&quot;Estimated Time&quot;,&quot;global_preferences&quot;:&quot;Global Preferences&quot;,&quot;no_notification_supported_on_your_browser&quot;:&quot;No notification style supported on your browser version&quot;,&quot;video_buffered&quot;:&quot;Video Buffered&quot;,&quot;buffered&quot;:&quot;Buffered&quot;,&quot;hyphen&quot;:&quot;-&quot;,&quot;buffered_message&quot;:&quot;The video has been buffered as requested and is ready to play.&quot;,&quot;not_supported&quot;:&quot;Not Supported&quot;,&quot;on&quot;:&quot;On&quot;,&quot;off&quot;:&quot;Off&quot;,&quot;click_to_enable_for_this_site&quot;:&quot;Click to enable for this site&quot;,&quot;desktop_notification_denied&quot;:&quot;You have denied permission for desktop notification for this site&quot;,&quot;notification_status_delimitor&quot;:&quot;;&quot;,&quot;error&quot;:&quot;Error&quot;,&quot;adblock_interferance_message&quot;:&quot;Adblock (or similar extension) is known to interfere with SmartVideo. Please add this url to adblock whitelist.&quot;,&quot;calculating&quot;:&quot;Calculating&quot;,&quot;waiting&quot;:&quot;Waiting&quot;,&quot;will_start_buffering_when_initialized&quot;:&quot;Will start buffering when initialized&quot;,&quot;will_start_playing_when_initialized&quot;:&quot;Will start playing when initialized&quot;,&quot;completed&quot;:&quot;Completed&quot;,&quot;buffering_stalled&quot;:&quot;Buffering is stalled. Will stop.&quot;,&quot;stopped&quot;:&quot;Stopped&quot;,&quot;hr&quot;:&quot;Hr&quot;,&quot;min&quot;:&quot;Min&quot;,&quot;sec&quot;:&quot;Sec&quot;,&quot;any_moment&quot;:&quot;Any Moment&quot;,&quot;popup_donate_to&quot;:&quot;Donate to&quot;,&quot;extension_id&quot;:&quot;lnkdbjbjpnpjeciipoaflmpcddinpjjp&quot;},&quot;prefs&quot;:{&quot;desktopNotification&quot;:true,&quot;soundNotification&quot;:true,&quot;logLevel&quot;:0,&quot;enable&quot;:true,&quot;loop&quot;:false,&quot;hidePopup&quot;:false,&quot;autoPlay&quot;:false,&quot;autoBuffer&quot;:false,&quot;autoPlayOnBuffer&quot;:false,&quot;autoPlayOnBufferPercentage&quot;:42,&quot;autoPlayOnSmartBuffer&quot;:true,&quot;quality&quot;:&quot;default&quot;,&quot;fshd&quot;:false,&quot;onlyNotification&quot;:false,&quot;enableFullScreen&quot;:true,&quot;saveBandwidth&quot;:false,&quot;hideAnnotations&quot;:false,&quot;turnOffPagedBuffering&quot;:false}}"></mytubeelement><mytubeelement id="myTubeRelayElementToTab" event="relayPrefs" data="{&quot;loadBundle&quot;:true}"></mytubeelement><div id="template-customizer" class="invert-bg-white" style="visibility: visible"> <a href="javascript:void(0)" class="template-customizer-open-btn" tabindex="-1"></a> <div class="p-4 m-0 lh-1 border-bottom template-customizer-header position-relative py-3"> <h4 class="template-customizer-t-panel_header mb-2">Template Customizer</h4> <p class="template-customizer-t-panel_sub_header mb-0">Customize and preview in real time</p> <div class="d-flex align-items-center gap-2 position-absolute end-0 top-0 mt-4 me-3"> <a href="javascript:void(0)" class="template-customizer-reset-btn text-body" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reset Customizer"><i class="ti ti-refresh ti-sm"></i><span class="badge rounded-pill bg-danger badge-dot badge-notifications"></span></a> <a href="javascript:void(0)" class="template-customizer-close-btn fw-light text-body" tabindex="-1"><i class="ti ti-x ti-sm"></i></a> </div> </div> <div class="template-customizer-inner pt-4"> <div class="template-customizer-theming"> <h5 class="m-0 px-4 py-4 lh-1 d-block"> <span class="template-customizer-t-theming_header bg-label-primary rounded-1 py-1 px-2 fs-big">Theming</span> </h5> <div class="m-0 px-4 pb-3 pt-1 template-customizer-style w-100"> <label for="customizerStyle" class="form-label d-block template-customizer-t-style_label">Style (Mode)</label> <div class="row px-1 template-customizer-styles-options"><div class="col-4 px-2">
            <div class="form-check custom-option custom-option-icon mb-0 checked">
              <label class="form-check-label custom-option-content p-0" for="styleRadiolight">
                <span class="custom-option-body mb-0">
                  <img src="../../assets/img/customizer/light.svg" alt="Style" class="img-fluid scaleX-n1-rtl">
                </span>
                <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="light" id="styleRadiolight" checked="checked">
              </label>
            </div>
            <label class="form-check-label small" for="themeRadioslight">Light</label>
          </div><div class="col-4 px-2">
            <div class="form-check custom-option custom-option-icon mb-0">
              <label class="form-check-label custom-option-content p-0" for="styleRadiodark">
                <span class="custom-option-body mb-0">
                  <img src="../../assets/img/customizer/dark.svg" alt="Style" class="img-fluid scaleX-n1-rtl">
                </span>
                <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="dark" id="styleRadiodark">
              </label>
            </div>
            <label class="form-check-label small" for="themeRadiosdark">Dark</label>
          </div><div class="col-4 px-2">
            <div class="form-check custom-option custom-option-icon mb-0">
              <label class="form-check-label custom-option-content p-0" for="styleRadiosystem">
                <span class="custom-option-body mb-0">
                  <img src="../../assets/img/customizer/system.svg" alt="Style" class="img-fluid scaleX-n1-rtl">
                </span>
                <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="system" id="styleRadiosystem">
              </label>
            </div>
            <label class="form-check-label small" for="themeRadiossystem">System</label>
          </div></div> </div> <div class="m-0 px-4 pt-3 template-customizer-themes w-100"> <label for="customizerTheme" class="form-label template-customizer-t-theme_label">Themes</label> <div class="row px-1 template-customizer-themes-options"><div class="col-4 px-2">
          <div class="form-check custom-option custom-option-icon mb-0 checked">
            <label class="form-check-label custom-option-content p-0" for="themeRadiostheme-default">
              <span class="custom-option-body mb-0">
                <img src="../../assets/img/customizer/default.svg" alt="Themes" class="img-fluid scaleX-n1-rtl">
              </span>
              <input class="form-check-input d-none" type="radio" name="themeRadios" id="themeRadiostheme-default" value="theme-default" checked="checked">
            </label>
            </div>
            <label class="form-check-label small" for="themeRadiostheme-default">Default</label>
        </div><div class="col-4 px-2">
          <div class="form-check custom-option custom-option-icon mb-0">
            <label class="form-check-label custom-option-content p-0" for="themeRadiostheme-bordered">
              <span class="custom-option-body mb-0">
                <img src="../../assets/img/customizer/border.svg" alt="Themes" class="img-fluid scaleX-n1-rtl">
              </span>
              <input class="form-check-input d-none" type="radio" name="themeRadios" id="themeRadiostheme-bordered" value="theme-bordered">
            </label>
            </div>
            <label class="form-check-label small" for="themeRadiostheme-bordered">Bordered</label>
        </div><div class="col-4 px-2">
          <div class="form-check custom-option custom-option-icon mb-0">
            <label class="form-check-label custom-option-content p-0" for="themeRadiostheme-semi-dark">
              <span class="custom-option-body mb-0">
                <img src="../../assets/img/customizer/semi-dark.svg" alt="Themes" class="img-fluid scaleX-n1-rtl">
              </span>
              <input class="form-check-input d-none" type="radio" name="themeRadios" id="themeRadiostheme-semi-dark" value="theme-semi-dark">
            </label>
            </div>
            <label class="form-check-label small" for="themeRadiostheme-semi-dark">Semi Dark</label>
        </div></div> </div> </div> <div class="template-customizer-layout"> <hr class="m-0 px-4 my-4"> <h5 class="m-0 px-4 pb-4 pt-2 d-block"> <span class="template-customizer-t-layout_header bg-label-primary rounded-1 py-1 px-2 fs-big">Layout</span> </h5> <div class="m-0 px-4 pb-3 d-block template-customizer-layouts"> <label for="customizerStyle" class="form-label d-block template-customizer-t-layout_label">Menu (Navigation)</label> <div class="row px-1 template-customizer-layouts-options"> <div class="col-4 px-2">
          <div class="form-check custom-option custom-option-icon mb-0">
            <label class="form-check-label custom-option-content p-0" for="layoutsRadiosexpanded">
              <span class="custom-option-body mb-0">
              <img src="../../assets/img/customizer/expanded.svg" alt="Layout Collapsed/Expanded" class="img-fluid scaleX-n1-rtl">
              </span>
              <input class="form-check-input d-none" type="radio" name="layoutsRadios" id="layoutsRadiosexpanded" value="expanded">
            </label>
            </div>
            <label class="form-check-label small" for="layoutsRadiosexpanded">Expanded</label>
            </div><div class="col-4 px-2">
          <div class="form-check custom-option custom-option-icon mb-0 checked">
            <label class="form-check-label custom-option-content p-0" for="layoutsRadioscollapsed">
              <span class="custom-option-body mb-0">
              <img src="../../assets/img/customizer/collapsed.svg" alt="Layout Collapsed/Expanded" class="img-fluid scaleX-n1-rtl">
              </span>
              <input class="form-check-input d-none" type="radio" name="layoutsRadios" id="layoutsRadioscollapsed" value="collapsed" checked="checked">
            </label>
            </div>
            <label class="form-check-label small" for="layoutsRadioscollapsed">Collapsed</label>
            </div></div> </div>  <div class="m-0 px-4 pb-3 template-customizer-layoutNavbarOptions w-100"> <label for="customizerNavbar" class="form-label template-customizer-t-layout_navbar_label">Navbar Type</label> <div class="row px-1 template-customizer-navbar-options"><div class="col-4 px-2">
          <div class="form-check custom-option custom-option-icon mb-0">
            <label class="form-check-label custom-option-content p-0" for="navbarOptionRadiossticky">
              <span class="custom-option-body mb-0">
                <img src="../../assets/img/customizer/sticky.svg" alt="Navbar Type" class="img-fluid scaleX-n1-rtl">
              </span>
              <input class="form-check-input d-none" type="radio" name="navbarOptionRadios" id="navbarOptionRadiossticky" value="sticky">
            </label>
            </div>
            <label class="form-check-label small" for="navbarOptionRadiossticky">Sticky</label>
        </div><div class="col-4 px-2">
          <div class="form-check custom-option custom-option-icon mb-0 checked">
            <label class="form-check-label custom-option-content p-0" for="navbarOptionRadiosstatic">
              <span class="custom-option-body mb-0">
                <img src="../../assets/img/customizer/static.svg" alt="Navbar Type" class="img-fluid scaleX-n1-rtl">
              </span>
              <input class="form-check-input d-none" type="radio" name="navbarOptionRadios" id="navbarOptionRadiosstatic" value="static" checked="checked">
            </label>
            </div>
            <label class="form-check-label small" for="navbarOptionRadiosstatic">Static</label>
        </div><div class="col-4 px-2">
          <div class="form-check custom-option custom-option-icon mb-0">
            <label class="form-check-label custom-option-content p-0" for="navbarOptionRadioshidden">
              <span class="custom-option-body mb-0">
                <img src="../../assets/img/customizer/hidden.svg" alt="Navbar Type" class="img-fluid scaleX-n1-rtl">
              </span>
              <input class="form-check-input d-none" type="radio" name="navbarOptionRadios" id="navbarOptionRadioshidden" value="hidden">
            </label>
            </div>
            <label class="form-check-label small" for="navbarOptionRadioshidden">Hidden</label>
        </div></div> </div> <div class="m-0 px-4 pb-3 template-customizer-content w-100"> <label for="customizerContent" class="form-label template-customizer-t-content_label">Content</label> <div class="row px-1 template-customizer-content-options"><div class="col-4 px-2">
              <div class="form-check custom-option custom-option-icon mb-0">
                <label class="form-check-label custom-option-content p-0" for="contentRadiocompact">
                  <span class="custom-option-body mb-0">
                    <img src="../../assets/img/customizer/compact.svg" alt="content type" class="img-fluid scaleX-n1-rtl">
                  </span>
                  <input name="contentRadioIcon&quot;" class="form-check-input d-none" type="radio" value="compact" id="contentRadiocompact">
                </label>
              </div>
              <label class="form-check-label small" for="contentRadioscompact">Compact</label>
            </div><div class="col-4 px-2">
              <div class="form-check custom-option custom-option-icon mb-0 checked">
                <label class="form-check-label custom-option-content p-0" for="contentRadiowide">
                  <span class="custom-option-body mb-0">
                    <img src="../../assets/img/customizer/wide.svg" alt="content type" class="img-fluid scaleX-n1-rtl">
                  </span>
                  <input name="contentRadioIcon&quot;" class="form-check-input d-none" type="radio" value="wide" id="contentRadiowide" checked="checked">
                </label>
              </div>
              <label class="form-check-label small" for="contentRadioswide">Wide</label>
            </div></div> </div> <div class="m-0 px-4 pb-3 template-customizer-directions w-100"> <label for="customizerDirection" class="form-label template-customizer-t-direction_label">Direction</label> <div class="row px-1 template-customizer-directions-options"><div class="col-4 px-2">
              <div class="form-check custom-option custom-option-icon mb-0 checked">
                <label class="form-check-label custom-option-content p-0" for="directionRadioltr">
                  <span class="custom-option-body mb-0">
                    <img src="../../assets/img/customizer/ltr.svg" alt="Directions" class="img-fluid">
                  </span>
                  <input name="directionRadioIcon&quot;" class="form-check-input d-none" type="radio" value="ltr" id="directionRadioltr" checked="checked">
                </label>
              </div>
              <label class="form-check-label small" for="directionRadiosltr">Left to Right</label>
            </div><div class="col-4 px-2">
              <div class="form-check custom-option custom-option-icon mb-0">
                <label class="form-check-label custom-option-content p-0" for="directionRadiortl">
                  <span class="custom-option-body mb-0">
                    <img src="../../assets/img/customizer/rtl.svg" alt="Directions" class="img-fluid">
                  </span>
                  <input name="directionRadioIcon&quot;" class="form-check-input d-none" type="radio" value="rtl" id="directionRadiortl">
                </label>
              </div>
              <label class="form-check-label small" for="directionRadiosrtl">Right to Left</label>
            </div></div> </div> </div> </div> </div><div><div id="draggable-element" style="position: fixed; top: 0px; right: 0px; z-index: 1000; visibility: visible;" draggable="true"><div id="captureUI" style="cursor:pointer;padding-top:123px;height:55px;width:128px;font-face:Verdana;font-weight:bolder;font-size:15px;text-align:center" class="disable" title="Click to Capture Auto Login Information"> Capture</div></div></div></body></html>
@endsection