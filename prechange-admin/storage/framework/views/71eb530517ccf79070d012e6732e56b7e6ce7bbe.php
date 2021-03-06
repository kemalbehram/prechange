<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard | Prechange </title>

    <!-- favicon !-->
     <link rel="shortcut icon" sizes="57x57" href="<?php echo e(url('images/favicon.jpeg')); ?>">
    <link rel="manifest" href="<?php echo e(url('favicon/manifest.json')); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/dist/css/material-design-iconic-font.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/js/jquery.scrollbar/jquery.scrollbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/fullcalendar.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/flatpickr.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/font-awesome/css/font-awesome.min.css')); ?>" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/pagination.css')); ?>"> 


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <?php echo $__env->yieldPushContent('customscripts'); ?>
</head>

<body data-sa-theme="11">
    <main class="main">
        <header class="header">
            <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                <i class="zmdi zmdi-menu"></i>
            </div>

            <div class="logo hidden-sm-down">
                <h1><a href="#">               
                    <img src="<?php echo e(url('/images/logo.png')); ?>" class="logo-text-1" />              
                </a></h1>
            </div>

            <ul class="top-nav">
                <li class="hidden-xl-up"><a href="#" data-sa-action="search-open"><i class="zmdi zmdi-search"></i></a></li>
                <li class="dropdown top-nav__notifications">
                    <a href="#" data-toggle="dropdown" class="top-nav__notify">
                        <i class="zmdi zmdi-notifications"></i> 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                </li>
            </ul>

            <div class="clock hidden-md-down">
                <div class="time">
                    <span class="hours"></span>
                    <span class="min"></span>
                    <span class="sec"></span>
                </div>
            </div>
            </header>

            <aside class="sidebar">
                <div class="scrollbar-inner">
                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <div>
                                <div class="user__name">Admin</div>
                                <div class="user__email">support@prechange.com</div>
                            </div>
                        </div>
                    </div>

                    <ul class="navigation">
                      <li class="@photogalleryactive">
                        <a href="<?php echo e(url('admin/dashboard')); ?>" class="<?php if(Request::segment(2) == 'dashboard'): ?> active <?php else: ?> <?php endif; ?>">
                            <i class="zmdi zmdi-view-dashboard"></i>
                        Dashboard
                    </a>
                </li>
                      <li class="@photogallery">
                        <a href="<?php echo e(url('admin/users')); ?>" class="<?php if(Request::segment(2) == 'users' || Request::segment(2) == 'users_edit'): ?> active <?php else: ?> <?php endif; ?>">
                            <i class="zmdi zmdi-accounts-alt"></i>
                             Users
                         </a>
                     </li> 

                     <li class="@colors"><a href="<?php echo e(url('admin/koboex_his')); ?>" class="<?php if(Request::segment(2) == 'koboex_his'): ?> active <?php else: ?> <?php endif; ?>"><i class="fa fa-history"></i> History</a></li>
                     

                <li class="@photogallery"><a href="<?php echo e(url('admin/commission')); ?>" class="<?php if(Request::segment(2) == 'commission'): ?> active <?php else: ?> <?php endif; ?>"><i class="zmdi zmdi-money"></i>Commission Settings</a></li>
           
                <li class="navigation__sub navigation__sub--toggled">
                    <a href="#" class="<?php if(Request::segment(2) == 'tc' || Request::segment(2) == 'privacy' || Request::segment(2) == 'aboutus' || Request::segment(2) == 'faq'|| Request::segment(2) == 'socialmedia'): ?> active <?php else: ?> <?php endif; ?>">
                        <i class="zmdi zmdi-settings" aria-hidden="true"></i>Site Settings</a>
                    <ul>
                     
                        <li class="@colorsactive"><a href="<?php echo e(url('admin/tc')); ?>">Terms & Conditions</a></li>
                        <li class="@colorsactive"><a href="<?php echo e(url('admin/privacy')); ?>">Privacy Policy</a></li>
             
                        <li class="@colorsactive"><a href="<?php echo e(url('admin/aboutus')); ?>">About Us</a></li>

                        <li class="@colorsactive"><a href="<?php echo e(url('admin/faq')); ?>">FAQ</a></li>
                        <!-- <li class="@colorsactive"><a href="<?php echo e(url('admin/review')); ?>">Reviews</a></li> -->
                        <li class="@colorsactive"><a href="<?php echo e(url('admin/socialmedia')); ?>">Soical Media</a></li>
                    </ul>
                </li>
                <li class="@photogalleryactive"><a href="<?php echo e(url('admin/security')); ?>" class="<?php if(Request::segment(2) == 'security'): ?> active <?php else: ?> <?php endif; ?>"><i class="zmdi zmdi-shield-check" aria-hidden="true"></i>Security Settings </a></li>

                <li class="@photogalleryactive"><a href="<?php echo e(url('logout')); ?>"><i class="zmdi zmdi-power-off"></i> Logout</a></li> 
            </ul>
        </div>
    </aside>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/layouts/header.blade.php ENDPATH**/ ?>