<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Company;
use App\Http\Controllers\Controller;
use App\Job;
use App\Location;
use App\Candidate;
use App\Candidatejob;
use App\Candidatedocument;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \Auth;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CandidateController extends Controller
{
    public function storeCandidates(Request $request) {
        $success = 0;
        $error = 1;
        $msg = "Something went wrong. Please try again.";
        $user = Auth::user();

        $post_data = $request->all();
        
        $rules = array(
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|digits:10',
            'birth_date' => 'required',
            'address' => 'required',
            'zipcode' => 'required|numeric',
            'hourly_rate' => 'required',
            'document_file' =>  'required|mimes:docx,pdf,PDF,DOCX,doc,DOC',
            'cv' =>  'required|mimes:docx,pdf,PDF,DOCX,doc,DOC'
        );
        
        $msgs = array(
            'full_name.required' => 'Required full name',
            'email.required' => 'Required email',
            'email.email' => 'Please enter valid email', 
            'phone_number.required' => 'Please enter valid phone number',
            'phone_number.numeric' => 'Please enter only digits in phone',
            'phone_number.digits' => 'Please enter 10 digits in phone',
            'birth_date.required' => 'Required birth date',
            'address.required' => 'Required address',
            'zipcode.required' => 'Required zipcode',
            'zipcode.numeric' => 'Please enter only digit in zipcode',
            'hourly_rate.required' => 'Required hourly rate',
            'document_file.required' => 'Please upload document.',
            'document_file.mimes' => 'Please upload only Doc or PDF file in document',
            'cv.required' => 'Please upload cv',
            'cv.mimes' => 'Please upload only Doc or PDF file in cv',
        );

        $validator = Validator::make($post_data, $rules, $msgs);
        //dd($validator);
        if ($validator->fails()) {
            $error = 2;
            $msg = $validator->getMessageBag()->toArray();
        } else {
            try {

                $data = [
                    'full_name' => $post_data['full_name'],
                    'email' => $post_data['email'],
                    'phone_number' => $post_data['phone_number'],
                    'gender' => $post_data['gender'],
                    'birth_date' => $post_data['birth_date'],
                    'address' => $post_data['address'],
                    'zipcode' => $post_data['zipcode'],
                    'created_by' => $user->id
                ];
                $candidate_id = Candidate::create($data)->id;
                $job_id = $request->job_id;


                Candidatejob::create([
                    'candidate_id' => $candidate_id,
                    'job_id' => $job_id,
                    'hourly_rate' => $post_data['hourly_rate'],
                    'created_by' => $user->id
                ]);

                if($request->hasfile('document_file') && isset( $_FILES['document_file']['name'] ) && $_FILES['document_file']['name'] ) {

                    $file_extension = $request->file('document_file')->getClientOriginalExtension();
                    $document_file = date('Y-m-d-His').$_FILES['document_file']['name'];
                    $document_size = $_FILES['document_file']['size'];
                    $request->document_file->move(public_path('img/document'), $document_file);
                    $document_name = $document_file;
                    Candidatedocument::create([
                        'candidate_id' => $candidate_id,
                        'is_cv' => 0,
                        'document' => $document_name
                    ]);
                }

                if($request->hasfile('cv') && isset( $_FILES['cv']['name'] ) && $_FILES['cv']['name'] ) {

                    $file_extension = $request->file('cv')->getClientOriginalExtension();
                    $cv_file = date('Y-m-d-His').$_FILES['cv']['name'];
                    $cv_size = $_FILES['cv']['size'];
                    $request->cv->move(public_path('img/cv'), $cv_file);
                    $cv_name = $cv_file;
                    Candidatedocument::create([
                        'candidate_id' => $candidate_id,
                        'is_cv' => 1,
                        'document' => $cv_name
                    ]);
                }
                $success = 1;
                $error = 0;
                $msg = "Candidate store successfully";
            } catch(Exception $e) {
                $msg = $e->getMessage();
            }
        }
        $responseData = [
            'success' => $success,
            'error' => $error,
            'msg' => $msg
        ];
        //dd($responseData);
        return response()->json( $responseData );  
    }
}
