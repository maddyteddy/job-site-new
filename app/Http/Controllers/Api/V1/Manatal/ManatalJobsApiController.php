<?php

namespace App\Http\Controllers\Api\V1\Manatal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Job;

class ManatalJobsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function fetch(){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.manatal.com/open/v3/jobs/', [
        'headers' => [
        'Authorization' => 'Token 1547683c6cc8002fc4a283ff944e2d083d888784',
        'accept' => 'application/json',
        ],
        ]);
        $res_data =  $response->getBody();
        $jobsList =  json_decode($res_data);
        // echo '<pre>';
        // print_r($jobsList);
        // exit;
        $jobArray = [];
        foreach($jobsList->results as $job) {
            //$record['id'] = $job->id;
            $record = [];

            $jobCheck = Job::where('job_id', $job->hash)->first();
            $record['job_id'] = $job->hash;
            $record['title'] = isset($job->position_name) ? $job->position_name : null;
            $record['full_description'] = $job->description;
            //$record['salary'] = isset($job->salary) ? $job->salary : 0;
           // $record['location_id'] = isset($job->location_id) ? $job->location_id : 1;
            //$record['company_id'] = isset($job->company_id) ? $job->company_id : 1;
            $record['career_page_url'] = isset($job->career_page_url) ? $job->career_page_url : 'test';
            $record['salary_min'] = $job->salary_min;
            $record['salary_max'] = $job->salary_max;
            $record['headcount'] = $job->headcount;
            $record['external_id'] = $job->external_id;
            $record['organization'] = $job->organization;
            $record['job_nature'] = $job->contract_details;
            $record['address'] = $job->address;
            $record['zipcode'] = $job->zipcode;
            $record['is_published'] = $job->is_published?$job->is_published:1;
            $record['creator'] = $job->creator;
            $record['currency'] = $job->currency;
            $record['is_remote'] = $job->is_remote;
            $record['status'] = $job->status;
            $start_date = date_create($job->created_at);
            $record['created_at'] = date_format($start_date,"Y-m-d H:i:s");
            $start_date = date_create($job->updated_at);
            $record['updated_at'] = date_format($start_date,"Y-m-d H:i:s");
            

            $record['industry'] = '';
            /*$record['address'] = $job->address;
            $record['zipcode'] = $job->zipcode;
            $record['is_published'] = $job->is_published;
            $record['creator'] = $job->creator;
            $record['currency'] = $job->currency;
            $record['is_remote'] = $job->is_remote;*/
            if($jobCheck) {
                //dd($record);
                Job::where('job_id', $job->hash)
                    ->update($record);
            } else {
                Job::create($record);
                // echo 'exit';exit;
            }
            
             
        }
        $jobs = Job::all();

        return redirect()->route('admin.jobs.index');
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
