<?php
namespace Views;

class ClienteView extends View {

    public function Render($body, $header = null, $footer = null, $data = []) {
        extract($data); // <-- extrai qualquer variável passada
        if (is_null($header)) {
            include(DEFAULT_VIEW_PATH . DEFAULT_HEADER);
        } else {
            include(DEFAULT_VIEW_PATH . $header);
        }

        include(DEFAULT_VIEW_PATH . $body);

        if (is_null($footer)) {
            include(DEFAULT_VIEW_PATH . DEFAULT_FOOTER);
        } else {
            include(DEFAULT_VIEW_PATH . $footer);
        }
    }
}
