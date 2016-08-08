<?php
namespace App\Http\Forms;

use App\Lib\Filesystem\CsvReader;
use Illuminate\Http\Request;

class ContactsUploadForm extends Form
{
    protected $rules = [
        'file' => 'required|mimes:txt,csv|mimetypes:text/csv,text/plain',
    ];

    protected $messages = [];
    /**
     * @var
     */
    private $reader;

    protected $userMessage = '';
    protected $numberCount = 0;
    protected $data;


    public function __construct(Request $request, CsvReader $reader)
    {
        parent::__construct($request);
        $this->reader = $reader;
    }


    public function persist()
    {
        if ($this->request->ajax()):
            $file = $this->request->file('file');

            if ($file->isValid()):
                try {
                    return $this->reader->readCsvNewLine($file);
                } catch (\Exception $e) {
                    return false;
                }
            endif;
        endif;
    }

    public function save()
    {
        if ($this->isValid()) {
            //get the numbers
            $this->data = $this->persist();
            //count the numbers
            //$this->numberCount($data);
            //store the numbers in session array
            //$this->storeSession($data);
            //return the numbers
            return $this->data;
        }
        return false;
    }


    public function storeSession($data)
    {
        $session = session('uploadedNumbersFromFile');
        if ($session):
            $count = count($session);
            session(["uploadedNumbersFromFile.$count" => $data]);
        else:
            session(['uploadedNumbersFromFile.0' => $data]);
        endif;

    }


    public function numberCount()
    {
        $numbers = explode(",", $this->data);
        return count($numbers);
    }



    public function getUserMessage()
    {
        return $this->userMessage;
    }
};