<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJobRequest;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
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

class JobsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::all();

        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('name', 'id');

        return view('admin.jobs.create', compact('companies', 'locations', 'categories'));
    }

    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->all());
        $job->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.jobs.index');
    }

    public function edit(Job $job)
    {
        abort_if(Gate::denies('job_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('name', 'id');

        $job->load('company', 'location', 'categories');

        return view('admin.jobs.edit', compact('companies', 'locations', 'categories', 'job'));
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $job->update($request->all());
        $job->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.jobs.index');
    }

    public function show(Job $job)
    {
        abort_if(Gate::denies('job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job->load('company', 'location', 'categories');

        return view('admin.jobs.show', compact('job'));
    }

    public function destroy(Job $job)
    {
        abort_if(Gate::denies('job_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobRequest $request)
    {
        Job::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCandidates(Request $request) {

        try {

            $post_data = $request->all();
            $user = Auth::user();

            
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
            return redirect()->route('admin.jobs.index');
        } catch(Exception $e) {
            return redirect()->route('admin.jobs.index');
            dd($e->getMessage());
        }
        

    }
}
