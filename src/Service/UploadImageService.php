<?php 

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;

class UploadImageService {

    public function __construct(private string $avatarFolder, private string $avatarFolderPublic, private Filesystem $filesystem)
    {

    }

    public function uploadProfileImage($avatar, $oldPicture = null)
    {

        $ext = $avatar->guessExtension() ?? 'bin';
        $filename = bin2hex(random_bytes(10)) .".". $ext;
        $avatar->move($this->avatarFolderPublic, $filename);

        if($oldPicture) {
            $oldPicturePath = $this->avatarFolder . "/" . pathinfo($oldPicture, PATHINFO_BASENAME);
            if ($this->filesystem->exists($oldPicturePath)) {
                $this->filesystem->remove($oldPicturePath);
            }
        }

        return $this->avatarFolderPublic."/".$filename;
    }
}



?>