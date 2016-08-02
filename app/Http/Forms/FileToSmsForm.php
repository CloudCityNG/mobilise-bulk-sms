<?php

namespace App\Http\Forms;

use Illuminate\Http\Request;
use App\Lib\Filesystem\CsvReader;

class FileToSmsForm extends Form
{
    protected $rules = [
        'contacts' => 'required|mimes:txt,csv|mimetypes:text/csv,text/plain',
    ];

    protected $messages = [];
    /**
     * @var
     */
    private $reader;
    protected $numbersCount = 0;
    protected $chopped;
    protected $data;


    public function __construct(Request $request, CsvReader $reader)
    {
        parent::__construct($request);

        $this->reader = $reader;
    }


    public function save()
    {
        if ($this->isValid()):
            $data = $this->persist();
            $this->storeSession($this->data);
            return $data;
        endif;
        return false;
    }


    public function persist()
    {
        $file = $this->request->file('contacts');
        if ($file->isValid()):
            try {
                $return = $this->reader->readCsvFile($file);
                $this->numbersCount = $return['count'];
                $this->chopped = $return['chop'];
                $this->data = $return['return'];
                return $this->chopped;
            } catch (\Exception $e) {
                return 'false1';
            }
        endif;
        return 'false2';

    }


    public function getNumberCount()
    {
        return $this->numbersCount;
    }


    public function storeSession($data)
    {
        if ( $this->request->session()->has('uploadedFileToSms')){
            $this->request->session()->forget('uploadedFileToSms');
        }
        $this->request->session()->put('uploadedFileToSms', $data);
    }

}