<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta http-equiv="Cache-control" content="public, max-age=86400">
    <meta property="og:image" content="http://img.zing.vn/vng/skin/vng-2014/image/vng-logo-share-v2.jpg"/>
    <link rel="shortcut icon"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->images; ?>/ico_cs_vng.ico"/>
    <?php echo $this->headTitle(); ?>
    <?php echo $this->headMeta(); ?>
    <?php echo $this->headLink(); ?>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans"/>
    <?php $token = Core_TokenKey::getInstance()->create_token(); ?>

    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->bootstrap; ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->bootstrap; ?>/css/bootstrap-responsive.min.css"/>
    <!-- gebo blue theme-->
    <link rel="stylesheet" href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/blue.css"
          id="link_theme"/>
    <!-- breadcrumbs-->
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->lib; ?>/jBreadcrumbs/css/BreadCrumb.css"/>
    <!-- tooltips-->
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->lib; ?>/qtip2/jquery.qtip.min.css"/>
    <!-- notifications -->
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->lib; ?>/sticky/sticky.css"/>
    <!-- code prettify -->
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->lib; ?>/google-code-prettify/prettify.css"/>
    <!-- notifications -->
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->lib; ?>/sticky/sticky.css"/>
    <!-- splashy icons -->
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->img; ?>/splashy/splashy.css"/>
    <!-- colorbox -->
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->lib; ?>/colorbox/colorbox.css"/>
    <!-- main styles -->
    <link rel="stylesheet"
          href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/style.css"/>
    <script src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->js; ?>/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <script type="text/javascript">
        var token = "<?php echo ($token != '') ? $token : ''; ?>";
    </script>
    
</head>
<body>
<?php echo $this->layout()->content; ?>
<?php echo $this->headScript(); ?>
<!--<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-15849003-1");
pageTracker._trackPageview();
} catch(err) {}
</script>-->
</body>
</html>