<?php namespace App\Repository;

use App\Models\Faq;
use Illuminate\Support\Facades\DB;

class FaqRepository {

    const DEFAULT_PAGINATE_SIZE = 6;
    const MAX_NO_OF_FAQ = 25;

    public function faqs()
    {
        //@TODO ->latest()
        return Faq::whereVisibility(1)->orderBy('position');
    }

    public function update($id, $input)
    {
        $row = Faq::find($id);
        $row->question = $input['question'];
        $row->answer = $input['answer'];
        $row->position = $input['position'];
        $row->visibility = $input['visibility'];
        return $row->save();
    }

    /**
     * @return mixed
     */
    public function usedPositions()
    {
        return DB::table('faq')->lists('position');
    }

    /**return an array of hidden Faq
     * @return mixed
     */
    public function hiddenFaq()
    {
        return Faq::whereVisibility(0)->orderBy('position');
    }


    /**
     * Hide Faq
     * @param $id
     * @return bool
     */
    public function hideFaq($id)
    {
        $faq = Faq::find($id);
        $faq->visibility = 0;
        return $faq->save();
    }

    /** Show Faq
     * @param $id
     * @return mixed
     */
    public function showFaq($id)
    {
        return DB::table('faq')
            ->where('id',$id)
            ->update(['visibility'=>1]);
    }


    /**
     * @param array $array
     * @return array
     */
    public function stripSpace(Array $array)
    {
        $input = array();

        foreach ($array as $key => $value)
        {
            $input[$key] = trim($value);
        }

        return $input;
    }

    /** Create a multi dimensional array form an array
     * @param array $array
     * @param $add_array
     * @return array
     */
    public function multi(Array $array,$add_array=null)
    {
        $r = [];
        foreach ( $array as $ar )
        {
            $r[$ar] = $ar;
        }
        $return = !is_null($add_array) ? array_add($r, $add_array, $add_array) : $r ;
        asort($return);
        return $return;
    }


    /** Get an array of positions for the FAQ
     * @param null $add_to_array
     * @return array
     */
    public function getPosition($add_to_array = null)
    {
        $available_positions = range(1, self::MAX_NO_OF_FAQ);
        $used_positions = $this->usedPositions();
        $positions = array_diff($available_positions, $used_positions);

        return $this->multi($positions, $add_to_array);
    }
}