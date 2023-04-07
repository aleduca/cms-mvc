<?php

namespace app\controllers\admin;

use app\classes\Upload;
use app\controllers\ContainerController;

class adminPostImageController extends ContainerController
{
    public function store()
    {
        $foto = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];

        $pasta = 'assets/images/site/posts';

        $upload = new Upload;
        $upload->pasta($pasta);
        $rename = $upload->rename($foto);
        $upload->upload($temp, $rename);

        echo '../../' . $pasta . '/' . $rename;
    }
}
