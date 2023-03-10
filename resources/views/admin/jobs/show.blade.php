@extends('layouts.admin')
@section('content')
<style>
    .error_group {
        color:red;
    }
</style>    
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.job.title') }}
        @can('job_candidate_add_allow')
        <button type="button" class="openModal btn btn-xs btn-primary" data-toggle="modal" data-id="{{$job->id}}">
        Add Candidate
        </button>
        @endcan
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.id') }}
                        </th>
                        <td>
                            {{ $job->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.external_id') }}
                        </th>
                        <td>
                            {{ $job->external_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.job_id') }}
                        </th>
                        <td>
                            {{ $job->job_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.title') }}
                        </th>
                        <td>
                            {{ $job->title }}
                        </td>
                    </tr>
                   
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.industry') }}
                        </th>
                        <td>
                            {{ $job->company->industry ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.organization') }}
                        </th>
                        <td>
                            {{ $job->organization ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.headcount') }}
                        </th>
                        <td>
                            {{ $job->headcount ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.creator') }}
                        </th>
                        <td>
                            {{ $job->creator ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.owner') }}
                        </th>
                        <td>
                            {{ $job->owner ?? '' }}
                        </td>
                    </tr>
                   
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.full_description') }}
                        </th>
                        <td>
                            {!! $job->full_description !!}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.job_nature') }}
                        </th>
                        <td>
                            {{ str_replace('_',' ',ucwords($job->job_nature)) ?? '' }}
                        </td>
                    </tr>
                  
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.address') }}
                        </th>
                        <td>
                            {{ $job->address }} {{ $job->zipcode }}
                        </td>
                    </tr>
                   
                   
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.salary_min') }}
                        </th>
                        <td>
                            {{ $job->salary_min }} {{ $job->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.salary_max') }}
                        </th>
                        <td>
                            {{ $job->salary_max }} {{ $job->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.is_remote') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled {{ $job->is_remote ? "checked" : "" }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.is_published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled {{ $job->is_published ? "checked" : "" }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.status') }}
                        </th>
                        <td>
                            {{ $job->status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.career_page_url') }}
                        </th>
                        <td>
                            <a href="{{ $job->career_page_url ?? '' }}" target="_blank">{{ $job->career_page_url ?? '' }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.is_pinned_in_career_page') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled {{ $job->is_pinned_in_career_page ? "checked" : "" }}>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Candidate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    @csrf 
                    <div class="form-group error_group" style="display:none;">
                    </div>
                    <div class="form-group">
                        <label for="full_name" class="col-form-label">Enter Full Name*</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Full Name">
                        <input type="hidden" name="job_id" id="job_id">
                    </div>
                  <div class="form-group">
                    <label for="email" class="col-form-label">Email*</label>
                     <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                    <label for="phone_number" class="col-form-label">Phone Number*</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number">
                  </div>
                  <div class="form-group">
                    <label for="" class="col-form-label">Gender</label>
                        <input type="radio" name="gender" value="Male" checked>Male
                         <input type="radio" name="gender" value="Female">Female
                  </div>
                   <div class="form-group">
                    <label for="birth_date" class="col-form-label">Birth of Date*</label>
                       <input type="date" name="birth_date" id="birth_date" class="form-control" placeholder="Enter Birth Date">
                  </div>
                    <div class="form-group">
                    <label for="address" class="col-form-label">Address*</label>
                       <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
                    </div>
                     <div class="form-group">
                    <label for="zipcode" class="col-form-label">Zipcode*</label>
                       <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Enter zipcode">
                    </div>
                    <div class="form-group">
                    <label for="hourly_rate" class="col-form-label">Hourly Rate*</label>
                     <input type="text" name="hourly_rate" id="hourly_rate" class="form-control" placeholder="Enter Hourly Rate">
                    </div>
                      <div class="form-group">
                    <label for="zipcode" class="col-form-label">Upload CV</label>
                       <input type="file" accept="application/pdf, document/*" name="cv" id="cv" class="form-control">
                    </div>
                     <div class="form-group">
                    <label for="zipcode" class="col-form-label">Upload Document</label>
                      <input type="file" accept="application/pdf, document/*" name="document" id="document" class="form-control">
                    </div>
                     
              </div>
              <div class="modal-footer">
                        <button class="btn btn-primary btn_save">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>    
    <!-- Model End -->    

    </div>
</div>

@endsection
@section('scripts')
@parent

<script>

    $(".openModal").click(function(){
        var job_id = $(this).attr("data-id");
        $("#job_id").val(job_id);
        $('#myModal').modal('show'); 

    });
    $(".close").click(function() {
        $('#myModal').hide();
    });

    $(".btn_save").click(function() {
        event.preventDefault();
        var url =  "{{ route('admin.candidates') }}";
        var full_name = $("#full_name").val();
        var email = $("#email").val();
        var phone_number = $("#phone_number").val();
        var gender = $('input[name="gender"]:checked').val();
        var address = $("#address").val();
        var zipcode = $("#zipcode").val();
        var birth_date = $("#birth_date").val();
        var job_id = $("#job_id").val();
        var hourly_rate = $("#hourly_rate").val();
        var document_file = {};
        if( $('#document')[0].files != undefined ){
          var document_file = $('#document')[0].files[0];  
        }


        var cv = {};
        if( $('#cv')[0].files != undefined ){
          var cv = $('#cv')[0].files[0];  
        }

        //if(full_name!="" && email!="" && phone_number!="" && address!="" && zipcode!="" && birth_date!="" && job_id != "" && hourly_rate!="" && cv!="" && document_file!="") {
            var formdata = new FormData();
            formdata.append('full_name', full_name);
            formdata.append('email', email);
            formdata.append('phone_number', phone_number);
            formdata.append('gender', gender);
            formdata.append('address', address);
            formdata.append('zipcode', zipcode);
            formdata.append('birth_date', birth_date);
            formdata.append('job_id', job_id);
            formdata.append('hourly_rate', hourly_rate);
            formdata.append('document_file', document_file);
            formdata.append('cv', cv);

            
            $.ajax({
              headers: {'x-csrf-token': $('meta[name="csrf-token"]').attr('content')},
              method: 'POST',
              url: url,
              data: formdata,
              contentType: false,
              processData: false,
              dataType: 'json',
              success: function( result ){

                if(result.success == 1){
                  alert(result.msg);
                  var urlRoute = "{{ route('admin.jobs.index') }}";
                  window.location.href = urlRoute;
                } else{
                   console.log(result.msg); 

                   $(".error_group").show();
                   $(".error_group").empty(); 
                   $.each(result.msg, function (fieldName, errorBag) {
                        //alert(errorBag);
                        let errorMessages = '';
                        $.each(errorBag, function(i, message) {
                            /*if(message == 'Please enter valid email' || message == 'Please enter valid phone number' || message == 'Please enter only digits in phone' || message == 'Please enter 10 digits in phone' || message == 'Please enter only digit in zipcode' || message == 'Please upload only Doc or PDF file in document' || message == 'Maximum file size to upload is 8MB (10 MB) in document' || message == 'Please upload only Doc or PDF file in cv' || message == 'Maximum file size to upload is 8MB (10 MB) in cv'){*/
                                errorMessages += message+'<br>';    
                            //}
                        });
                        $(".error_group").append(errorMessages);
                    });
                    //alert('test');  
                    //setTimeout(function(){ $(".error_group").hide() }, 10000);
                }
              }
            });    
        //}

        
    });
</script>    

@endsection