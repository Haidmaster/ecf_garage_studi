<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PictureService
{

    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function add(
        UploadedFile $picture,
        ?string $folder = '',
        ?int $width = 250,
        ?int $height = 250
    ) {
        // On donne un nouveau à l'image
        $fichier = md5(uniqid(rand(), true)) . '.webp';

        // On récupère les infos de l'image
        $pictureInfos = getImagesize($picture);

        if ($pictureInfos === false) {
            throw new Exception('Format d\' image incorrect');
        }

        // On vérifie le format de l'image
        switch ($pictureInfos['mime']) {
            case 'image/png':
                $sourcePicture = imagecreatefrompng($picture);
                break;
            case 'image/jpeg':
                $sourcePicture = imagecreatefromjpeg($picture);
                break;
            case 'image/webp':
                $sourcePicture = imagecreatefromwebp($picture);
                break;
            default:
                throw new Exception('Format d\'image incorrect');
        }

        // On recadre l'image
        // On récupère les dimensions
        $imageWidth = $pictureInfos[0];
        $imageHeight = $pictureInfos[1];

        // On vérifie l'orientation de l'image avec un spaceship       
        switch ($imageWidth <=> $imageHeight) {
            case -1: // Si la largeur et inférieur à la hauteur (portrait)
                $squareSize = $imageWidth;
                $src_x = 0;
                $src_y = ($imageHeight - $squareSize) / 2;
                break;

            case 0: // carré
                $squareSize = $imageWidth;
                $src_x = 0;
                $src_y = 0;
                break;
            case 1: // paysage
                $squareSize = $imageHeight;
                $src_x = ($imageWidth - $squareSize) / 2;
                $src_y = 0;
                break;
        }
        // On créer une nouvelle image "vierge"
        $resizedPicture = imagecreatetruecolor($width, $height);

        imagecopyresampled($resizedPicture, $sourcePicture, 0, 0, $src_x, $src_y, $width, $height, $squareSize, $squareSize);

        $path = $this->params->get('images_directory') . $folder;

        $picture->move($path . '/', $fichier);

        return $fichier;
    }

    public function delete(
        string $fichier,
        ?string $folder = '',
        ?int $width = 250,
        ?int $height = 250
    ) {

        if ($fichier !== 'default.webp') {
            $success = false;
            $path = $this->params->get('images_directory') . $folder;

            $mini =  $path . '/mini/' . $width . 'x' . $height . '-' . $fichier;

            if (file_exists($mini)) {
                unlink($mini);
                $success = true;
            }

            $original = $path . '/' . $fichier;

            if (file_exists($original)) {
                unlink($mini);
                $success = true;
            }
            return $success;
        }
        return false;
    }
}
