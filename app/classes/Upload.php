<?php

namespace app\classes;

use Intervention\Image\ImageManager;

class Upload
{
    /**
     * @var mixed
     */
    private $manager;
    /**
     * @var mixed
     */
    private $novoNome;
    /**
     * @var mixed
     */
    private $resize;
    /**
     * @var mixed
     */
    private $pasta;

    public function __construct()
    {
        $this->manager = new ImageManager;
    }

    /**
     * @param $file
     */
    private function extension($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * @param $file
     */
    public function rename($file)
    {
        return md5(uniqid(true)) . '.' . $this->extension($file);
    }

    /**
     * @param $pasta
     */
    public function pasta($pasta)
    {
        $this->pasta = $pasta;
    }

    /**
     * @param $width
     * @param $height
     * @param $target
     */
    private function resize($width, $height, $target)
    {
        $percent = ($width > $height) ? ($target / $width) : ($target / $height);

        $width = round($width * $percent);
        $height = round($height * $percent);

        return ['width' => $width, 'height' => $height];
    }

    /**
     * @param $temp
     */
    public function upload($temp, $rename)
    {
        $dimensoesFoto = getimagesize($temp);

        $resize = $this->resize($dimensoesFoto[0], $dimensoesFoto[1], 640);

        $caminho = $this->pasta . '/' . $rename;

        $image = $this->manager->make($temp)->resize($resize['width'], $resize['height'], function ($constrain) {
            $constrain->aspectRatio();
            $constrain->upsize();
        });

        $image->save($caminho);
    }

    /**
     * @param $temp
     */
    public function uploadFotoUser($temp, $rename)
    {
        $dimensoesFoto = getimagesize($temp);

        $resize = $this->resize($dimensoesFoto[0], $dimensoesFoto[1], 300);

        $caminho = $this->pasta . '/' . $rename;

        $background = $this->manager->canvas(190, 190);

        $image = $this->manager->make($temp)->resize($resize['width'], $resize['height'], function ($constrain) {
            $constrain->aspectRatio();
            $constrain->upsize();
        });

        $background->insert($image, 'center');
        $background->fit(300, 300);
        $background->save($caminho);
    }

    /**
     * @param $file
     */
    public function excluir($file)
    {
        if (file_exists($file)) {
            @unlink($file);
            return true;
        }
        return false;
    }
}
