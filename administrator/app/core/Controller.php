<?php

namespace Administrator\App\Core;

use App\Core\Controller as CoreController;

class Controller extends CoreController {

    public function isAdmin() {
        if (isset($_SESSION['roleId']))
            if ($_SESSION['roleId'] == 1)
                return true;

        return false;
    }
    
}
