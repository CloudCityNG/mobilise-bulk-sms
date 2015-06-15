<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Repository\FaqRepository;
use Illuminate\Http\Request;

class FaqController extends Controller {

    const MAX_NO_OF_FAQ = 25;
    /**
     * @var FaqRepository
     */
    private $faqRepository;

    function __construct(FaqRepository $faqRepository)
    {
        $this->middleware('auth', ['only'=>['store','create']]);
        $this->faqRepository = $faqRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param FaqRepository $repository
     * @return Response
     */
	public function index()
	{
		//display/paginate the faq list
        $d = $this->faqRepository->faqs();
        $h = $this->faqRepository->hiddenFaq();


        if ($d->count())
        {
           //dd($d->get());
            return view('payquic.faq.index', ['data'=>$d, 'hidden'=>$h]);
        }

        return null;

	}

    /**
     * Show the form for creating a new resource.
     *
     * @param FaqRepository $repository
     * @return Response
     */
	public function create()
	{
        return view('payquic.faq.create', ['position'=>$this->faqRepository->getPosition()]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param FaqRequest $request
     * @return Response
     */
	public function store(FaqRequest $request)
	{
        Faq::firstOrCreate($this->faqRepository->stripSpace($request->only('question','answer','position','visibility')));
        flash()->overlay('<b>Saved Successfully</b>');
        return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//show one faq from id
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $faq = Faq::find($id);
        $position = $this->faqRepository->getPosition($faq->position);
		//edit faq record by id
        return view('payquic.faq.edit', ['faq'=>$faq, 'position'=>$position]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, FaqRequest $request)
	{
		//update faq by id
        $this->faqRepository->update($id, $request->only('question','answer','position','visibility'));
        flash()->overlay('<b>Edit Completed<b>');
        return redirect()->to('faq');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//delete faq
	}

    public function hide($faq)
    {
        $this->faqRepository->hideFaq($faq);
        return redirect()->back();
    }

    public function show_($faq)
    {
        $this->faqRepository->showFaq($faq);
        return redirect()->back();
    }

}
