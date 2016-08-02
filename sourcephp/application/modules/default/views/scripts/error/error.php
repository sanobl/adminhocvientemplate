<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--        <link rel="stylesheet" type="text/css" href="<?php echo $this->app->static->frontend->css; ?>/style.<?php echo Core_Global::getKeyPrefixCaching('staticversion'); ?>.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->app->static->frontend->css; ?>/boxy.<?php echo Core_Global::getKeyPrefixCaching('staticversion'); ?>.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->app->static->frontend->css; ?>/reset.<?php echo Core_Global::getKeyPrefixCaching('staticversion'); ?>.css"/>-->
    </head>
    <body style="background-image:none">
        <table width="600" cellspacing="0" cellpadding="20" border="0" align="center" style="border: 1px dashed #999999">
            <tbody><tr>
              <td align="center"><center>
              <p style="color:#FF0000">Hệ thống không tìm thấy trang bạn yêu cầu, Xin vui lòng kiểm tra lại URL!</p>
              [ <a href="/">Quay lại trang chủ</a> ]
              <br>
              </center>
                          </td>
            </tr>
          </tbody></table>
        <?php
        if (APPLICATION_ENV == 'development') {
            ?>
            <div>
                <h2><?php echo $this->message; ?></h2>
                <h3>Exception information:</h3>
                <p> <b>Message:</b> <?php echo $this->exception->getMessage(); ?> </p>
                <h3>Stack trace:</h3>
                <pre><?php echo $this->exception->getTraceAsString(); ?></pre>
                <h3>Request Parameters:</h3>
                <pre><?php print_r($this->request->getParams()); ?></pre>
            </div>
            <div class="clear"></div>
        <?php } ?>
        <?php if (isset($_GET['debug'])) { ?>
            <script language="javascript">
                if (typeof console !== "undefined") {
                    console.log('%s', '<?php echo $this->message; ?>');
                }
<?php } ?>
        </script>
    </body>
</html>