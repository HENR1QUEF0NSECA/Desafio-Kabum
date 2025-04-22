<?php
namespace Views;
const DEFAULT_HEADER = "header.php";
const DEFAULT_FOOTER = "footer.php";
const DEFAULT_VIEW_PATH = "Views/templates/";
    class View{

        public function Render($body, $header = null, $footer = null) {
            if (is_null($header)) { include(DEFAULT_VIEW_PATH . DEFAULT_HEADER); }
            else { include(DEFAULT_VIEW_PATH . $header); }
            include(DEFAULT_VIEW_PATH . $body);
            if (is_null($footer)) { include(DEFAULT_VIEW_PATH . DEFAULT_FOOTER); }
            else { include(DEFAULT_VIEW_PATH . $footer); }
        }
    }
