
    <!-- smart resize event -->
    <script src="<?php echo $this->getView()->app->static->frontend->js; ?>/jquery.debouncedresize.min.js"></script>
    <!-- hidden elements width/height -->
    <script src="<?php echo $this->getView()->app->static->frontend->js; ?>/jquery.actual.min.js"></script>
    <!-- js cookie plugin -->
    <script src="<?php echo $this->getView()->app->static->frontend->js; ?>/jquery.cookie.min.js"></script>
    <!-- main bootstrap js -->
    <script src="<?php echo $this->getView()->app->static->frontend->bootstrap; ?>/js/bootstrap.min.js"></script>
    <!-- bootstrap plugins -->
    <script src="<?php echo $this->getView()->app->static->frontend->js; ?>/bootstrap.plugins.min.js"></script>
    <!-- code prettifier -->
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/google-code-prettify/prettify.min.js"></script>
    <!-- tooltips -->
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/qtip2/jquery.qtip.min.js"></script>
    <!-- jBreadcrumbs -->
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
    <!-- sticky messages -->
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/sticky/sticky.min.js"></script>
    <!-- fix for ios orientation change -->
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/ios-orientationchange-fix.js"></script>
    <!-- scrollbar -->
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/antiscroll/antiscroll.js"></script>
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/antiscroll/jquery-mousewheel.js"></script>
    <!-- lightbox -->
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/colorbox/jquery.colorbox.min.js"></script>
    <!-- common functions -->
    <script src="<?php echo $this->getView()->app->static->frontend->js; ?>/gebo_common.js"></script>
    <script src="<?php echo $this->getView()->app->static->frontend->lib; ?>/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $this->getView()->app->static->frontend->js; ?>/gebo_forms.js"></script>
    <script>
        $(document).ready(function() {
            //* show all elements & remove preloader
            setTimeout('$("html").removeClass("js")', 1000);
        });
    </script>