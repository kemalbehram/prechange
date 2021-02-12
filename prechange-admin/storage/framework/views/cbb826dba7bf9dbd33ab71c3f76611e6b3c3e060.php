<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel | <?php echo e(config('app.name')); ?> </title>
    <!-- favicon !-->
    
   
    <link rel="shortcut icon" sizes="57x57" href="<?php echo e(url('images/favicon.jpeg')); ?>">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/material-design-iconic-font.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/animate.min.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet">
    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/app.min.css')); ?>">
</head>
<body data-sa-theme="11">
    <!-- Login -->
    <div class="login">
        <div class="login__block active" id="l-login">
            <img src="<?php echo e(url('/images/logo.png')); ?>" class="logo-text" />
            <div class="login__block__header">
                <i class="zmdi zmdi-account-circle"></i>
                Admin Panel                 
            </div>
            <div class="login__block__body">

            <?php if(session('login_error')): ?>
					    <div class="alert alert-success">
                              <?php echo e(session('login_error')); ?>

                        </div>
					<?php endif; ?>

                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>" autocomplete="nope">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <input type="text" class="form-control text-center" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email">
                        <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control text-center" placeholder="Password">
                        <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php if(isset($status)): ?>
                        <span class="help-block">
                            <strong><?php echo e($status); ?></strong>
                        </span>
                    <?php endif; ?>
                    <button type="submit" name="secure-adminlogin" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo e(url('adminpanel/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(url('adminpanel/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('adminpanel/js/bootstrap.min.js')); ?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="<?php echo e(url('adminpanel/js/app.min.js')); ?>"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/welcome.blade.php ENDPATH**/ ?>