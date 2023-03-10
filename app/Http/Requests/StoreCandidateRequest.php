<?php

namespace App\Http\Requests;

use App\Category;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCandidateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('job_candidate_add_allow'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'full_name'  => ['required'],
            'email'   => [
                'required',
                'email',
            ],
             'phone_number'   => [
                'required',
                'numeric',
                'digits:10'
            ],
            'birth_date'=> ['required'],
            'address'=> ['required',''],
            'zipcode'=> ['required'],
            'hourly_rate'=> ['required'],
            'document_file'=> ['required','mimes:docx,pdf,PDF,DOCX,doc,DOC','max:10240'],
            'cv'=> ['required','mimes:docx,pdf,PDF,DOCX,doc,DOC','max:10240'],
        ];
    }
}
