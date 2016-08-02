<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="format-detection" content="telephone=no" />
        <meta name="robots" content="INDEX,FOLLOW"/>
        <meta http-equiv="Cache-control" content="public, max-age=86400">
        <meta property="og:image" content="http://img.zing.vn/vng/skin/vng-2014/image/vng-logo-share-v2.jpg"/>
        <link rel="shortcut icon" href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->images; ?>/ico_cs_vng.ico" />
        <?php echo $this->headTitle(); ?>
        <?php echo $this->headMeta(); ?>
        <?php echo $this->headLink(); ?>
        <?php $token = Core_TokenKey::getInstance()->create_token();?>
        <link href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/bootstrap.css" rel="stylesheet"/>
        <link href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/bootstrap-theme.css" rel="stylesheet"/>
        <link href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/style.css" rel="stylesheet"/>
        <link href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/font-awesome.css" rel="stylesheet"/>
        <link href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->source; ?>/jquery.fancybox.css" rel="stylesheet"/>
        <link href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/datepicker.css" rel="stylesheet"/>
        <link href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/datepicker3.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/dataTables.bootstrap.css"/>
        <link rel="stylesheet" href="<?php echo Core_Global::getApplicationIni()->app->static->frontend->css; ?>/dataTables.responsive.css"/>      
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            
        <![endif]-->
        <script src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->js; ?>/jquery-1.11.2.js"></script>
        <script src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->js; ?>/bootstrap.min.js"></script>        
        <script type="text/javascript" src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->js; ?>/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->source; ?>/jquery.fancybox.pack.js"></script>
        <script src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->js; ?>/bootstrap-datepicker.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->js; ?>/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->js; ?>/dataTables.responsive.min.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->js; ?>/dataTables.bootstrap.js"></script>
        <script type="text/javascript">
            var token = "<?php echo ($token != '')?  $token: ''; ?>";
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