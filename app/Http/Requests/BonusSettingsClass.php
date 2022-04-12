<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BonusSettingsClass extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'assetbonus'        =>  'required|nullable',
            'cashbonus'         =>  'required|nullable',
            'charitybouns'      =>  'required|nullable',
            'vatandtax'         =>  'required|nullable',
            'mamazpoisha'       =>  'required|nullable',
            'foundershipbonus'  =>  'required|nullable',
            'nonsponsorbonus'   =>  'required|nullable',
            'landcoverage'      =>  'required|nullable',
            'clubbonus'         =>  'required|nullable',
            'bestperformancebonus'  =>  'required|nullable',
            'withdrwacharge'    =>  'required',
            'TargetSell'        =>  'required|nullable',
            'giftandtoure'      =>  'required|nullable',
            '5generationbonus'  =>  'required|nullable',
            'nontargetbonus'  =>  'required|nullable',
            'followupbonus'  =>  'required|nullable',
            'hondaandcar'  =>  'required|nullable',
            'landinsurance'  =>  'required|nullable',
            'developmentbonus'  =>  'required|nullable',
            'ServiceCharge'  =>  'required|nullable',
            'gccf'          =>  'required|nullable',
        ];
    }
}
