<?php namespace App\Lib\Filesystem;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Usage.
 * prepare inputs || $file = Input::file('file') || $destination = public_path('img/songs')
 * $filename = Str::ranndom(7) || this will be concatenated with the real file name
 * $f = new FileUpload($file, $destination, $filename);
 * $f->getFileName, $f->getFileSize, $f->getFileUrl
* Class FileUpload
 * @package App\Lib\Files
 */

class FileUpload {


    private $fileInput;
    private $destination;
    /**
     * @var null
     */
    private $filename;


    function __construct(UploadedFile $fileInput, $destination, $filename=null)
    {
        if (!$fileInput || !$destination):
            Throw new \Exception("File Input or destination required.");
        endif;

        $this->fileInput = $fileInput;
        $this->destination = $destination;
        $this->filename = $filename;

        $this->prepareFile();
    }


    private function prepareFile()
    {
        //get file name. prepend a name if given
        $fileName = ($this->filename) ?: $this->fileInput->getClientOriginalName();
        //replace spaces with underscores
        $this->filename = $this->replaceSpace($fileName);

        if ( $this->fileInput->isValid() ):
            $this->fileInput->move($this->destination, $this->filename);
        return true;
        else:
            throw new \Exception('File is not valid');
        endif;
    }

    private function replaceSpace($text)
    {
        return str_replace(" ", "_", $text);
    }

    public function getFileName()
    {
        return $this->filename;
    }

    public function getFileSize()
    {
        return $this->fileInput->getClientSize();
    }

    public function getFileUrl()
    {
        return realpath($this->destination.'/'.$this->filename);
    }

}