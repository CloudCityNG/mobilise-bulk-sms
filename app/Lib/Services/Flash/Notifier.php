<?php


namespace App\Lib\Services\Flash;


use Illuminate\Http\Request;

class Notifier {


    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {

        $this->request = $request;
    }


    public function timer($message, $timer=2000)
    {
        $this->flash($message, 'Notification', 'info', $timer);
        return $this;
    }


    public function overlay($message, $header='Notification')
    {
        $this->info($message, $header);
        return $this;
    }

    public function info($message, $header='Notification')
    {
        $this->flash($message, $header, 'info');
        return $this;
    }


    public function message($message, $header='Notification')
    {
        $this->flash($message, $header, 'message');
        return $this;
    }


    public function success($message, $header='Success')
    {
        $this->flash($message, $header, 'success');
        return $this;
    }


    public function error($message, $header='Error')
    {
        $this->flash($message, $header, 'error');
        return $this;
    }


    public function flash($message, $header, $level = 'warning', $timer=null)
    {
        $this->request->session()->flash('flash.message', $message);
        $this->request->session()->flash('flash.header', $header);
        $this->request->session()->flash('flash.level', $level);
        if ( $timer )
            $this->request->session()->flash('flash.timer', $timer);

    }

} 