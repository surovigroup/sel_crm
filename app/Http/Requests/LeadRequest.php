<?php

namespace App\Http\Requests;

use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
        $rules = [
            'name'              => 'required',
            'phone'             => 'required|digits:11|unique:leads',
            'email'             => 'nullable|email|unique:leads',
            'source'            => 'required',
            'company'           => 'nullable',
            'description'       => 'nullable',
            'district'          => 'nullable',
            'division'          => 'nullable',
            'upazila'           => 'nullable',
            'note'              => 'nullable',
            'admin_assigned_id' => 'required',
            'status_id'         => 'required',
        ];

        if($this->method() == 'PATCH'){
            $rules['phone'] = 'required|digits:11|unique:leads,phone,' . $this->lead->id;
            $rules['email'] = 'nullable|email|unique:leads,email,' . $this->lead->id;
        }

        if($this->method() == 'POST'){
            $rules['admin_created_id'] = 'required';
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'admin_assigned_id' => $this->admin_assigned_id ?? auth()->user()->id,
            'status_id' => $this->status_id ?? Status::first()->id,
        ]);
        if($this->method() == 'POST'){
            $this->merge([
                'admin_created_id' => auth()->user()->id
            ]);
        }
    }
}
