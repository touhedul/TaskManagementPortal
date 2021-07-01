<?php

namespace App\Http\Requests\API;

use App\Models\Employee;
use InfyOm\Generator\Request\APIRequest;

class UpdateEmployeeAPIRequest extends APIRequest
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
        $rules = Employee::$rules;


        $rules = array_merge($rules, [
            'image' => 'nullable|image|max:10000',
        ]);
        // $rules = array_merge($rules,['file' => 'nullable|mimes:jpg,png,jpeg,gif,doc,docx,pdf,ppt,pptx,xls,xlsx|max:10000']);
        return $rules;

    }
}
