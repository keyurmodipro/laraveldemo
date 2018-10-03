
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

        <script>
            WebFont.load({
                google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700", "Asap+Condensed:500"]},
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <!--<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />RTL version:<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <!--end::Page Vendors Styles -->
        <!--begin::Base Styles -->
        <link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" /><!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <link href="assets/demo/demo10/base/style.bundle.css" rel="stylesheet" type="text/css" /><!--RTL version:<link href="assets/demo/demo10/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <!--end::Base Styles -->
        <link rel="shortcut icon" href="assets/demo10/demo/media/img/logo/favicon.ico" /> 
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
        <style>
            body { margin:0; padding:0; }
            #map { position:relative; top:0; bottom:0; width:100%;height: 100%; }
            .legend {
                display: none;
                background-color: rgb(222, 239, 240,0.7);
                border-radius: 3px;
                bottom: 30px;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
                padding: 10px;
                position: absolute;
                right: 30px;
                z-index: 1;
                width: 180px;
            }

            .legend h4 {
                margin: 0 0 10px;
            }

            .legend p {
                margin: 0 0 0 30px;
                position: absolute;
                display: block;
                top: 0;
            }

            .legend div {
                position: relative;
            }

            .legend div span {
                border-radius: 50%;
                display: inline-block;
                margin-right: 5px;
                opacity: 0.8;
                background-color: #d49a66;
            }

            .panel{
                width: 100%;
            }
            .lightmap{
                height: 600px;display: inline-block;
            }

            .m-portlet .m-portlet__head .m-portlet__head-tools .btn {
                margin-top: 0px !important;
                margin-bottom: 0px !important;
            }
            .toggle{
                width: 80px !important;
            }
            #error{
                display: none;
            }
        </style>
    </head>

    <body class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">
        <div class="m-page-loader m-page-loader--base">
            <div class="m-blockui">
                <span>Please wait...</span>
                <span>
                    <div class="m-loader m-loader--brand"></div>
                </span>
            </div>
        </div>
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!--<div class="main_container" id="main_container">-->
            <header id="m_header" class="m-grid__item m-header "  m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10" >
                <div class="m-header__top">
                    <div class="m-container m-container--fluid m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">		
                            <!-- begin::Brand -->
                            <div class="m-stack__item m-brand m-stack__item--left">
                                <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                        <a href="/" class="m-brand__logo-wrapper">
                                            <img alt="" src="assets/demo/demo10/media/img/logo/logo.png" class="m-brand__logo-desktop"/>
                                            <img alt="" src="assets/demo/demo10/media/img/logo/logo_mini.png" class="m-brand__logo-mobile"/>
                                        </a>  
                                    </div>
                                    <div class="m-stack__item m-stack__item--middle m-brand__tools">	

                                        <!-- begin::Responsive Header Menu Toggler-->
                                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                            <span></span>
                                        </a>
                                        <!-- end::Responsive Header Menu Toggler-->


                                        <!-- begin::Topbar Toggler-->
                                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                            <i class="flaticon-more"></i>
                                        </a>
                                        <!--end::Topbar Toggler-->
                                    </div>
                                </div>
                            </div>
                            <!-- end::Brand -->		
                            <!-- begin::Topbar -->
                            <div class="m-stack__item m-stack__item--right m-header-head" id="m_header_nav">
                                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                                    <div class="m-stack__item m-topbar__nav-wrapper">
                                        <ul class="m-topbar__nav m-nav m-nav--inline" style="display: table;">



                                            <li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                                <a class="" href="/addmovies" style="cursor: pointer;padding-top: 30px;display: table-cell;">
<!--                                                    <span class="m-topbar__userpic">-->
                                                    Add Movie
                                                    <!--</span>-->                   
                                                </a>
                                            </li>
                                            @if(!Auth::check())
                                            <li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                                <a class="" href="/login" style="cursor: pointer;padding-top: 30px;display: table-cell;">
<!--                                                    <span class="m-topbar__userpic">-->
                                                    Login
                                                    <!--</span>-->                   
                                                </a>
                                            </li>
                                            @endif
                                            @if(Auth::check())
                                            <li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                                    <span class="m-topbar__userpic">
                                                        <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                                                    </span>
                                                    <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                                                        <span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
                                                    </span>
                                                    <span class="m-topbar__username m--hide">Brittany</span>                    
                                                </a>
                                                <div class="m-dropdown__wrapper">
                                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                    <div class="m-dropdown__inner">
                                                        <div class="m-dropdown__header m--align-center">
                                                            <div class="m-card-user m-card-user--skin-light">
                                                                <div class="m-card-user__pic">
                                                                    <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt=""/>
                                                                </div>
                                                                <div class="m-card-user__details">
                                                                    <span class="m-card-user__name m--font-weight-500">Brittany Jade</span>
                                                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">info@qualisflow.com</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-dropdown__body">
                                                            <div class="m-dropdown__content">
                                                                <ul class="m-nav m-nav--skin-light">
                                                                    <li class="m-nav__section m--hide">
                                                                        <span class="m-nav__section-text">Section</span>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="profile.html" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                            <span class="m-nav__link-title">  
                                                                                <span class="m-nav__link-wrap">      
                                                                                    <span class="m-nav__link-text">My Profile</span>      
                                                                                    <span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>  
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="profile.html" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                                            <span class="m-nav__link-text">Activity</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="profile.html" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                            <span class="m-nav__link-text">Messages</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                                    </li>


                                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="/logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            <li id="m_quick_sidebar_toggle" class="m-nav__item m-nav__item--info m-nav__item--qs">
                                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                                    <span class="m-nav__link-icon m-nav__link-icon-alt"><span class="m-nav__link-icon-wrapper"><i class="flaticon-grid-menu"></i></span></span>
                                                </a>
                                            </li>           
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- end::Topbar -->	</div>
                    </div>
                </div>
                <div class="m-header__bottom">
                    <div class="m-container m-container--fluid m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">		
                            <!-- begin::Horizontal Menu -->
                            <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
                                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                            </div>
                            <!-- end::Horizontal Menu -->	
                        </div>
                    </div>  
                </div>
            </header>
            <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
                @yield('content')
            </div>
        </div>
        @include('layouts.js')

        @yield('scripts')


    </body>

</html>

