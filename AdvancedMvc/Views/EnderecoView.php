<?php
namespace Views;

class EnderecoView extends View {
    public function Render($body, $header = null, $footer = null, $data = [], $extraData = null) {
        // Garante que as variáveis padrão estejam disponíveis
        $cliente = $extraData ?? [];
        $endereco    = $data ?? [];
        
        // Inclui o header
        if (is_null($header)) {
            include(DEFAULT_VIEW_PATH . DEFAULT_HEADER);
        } else {
            include(DEFAULT_VIEW_PATH . $header);
        }
        
        // Inclui o corpo principal
        include(DEFAULT_VIEW_PATH . $body);
        
        // Inclui o footer
        if (is_null($footer)) {
            include(DEFAULT_VIEW_PATH . DEFAULT_FOOTER);
        } else {
            include(DEFAULT_VIEW_PATH . $footer);
        }
    }
}