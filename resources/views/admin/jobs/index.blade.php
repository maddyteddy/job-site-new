@extends('layouts.admin')
@section('content')
<style>
    .error_group {
        color:red;
    }
</style> 
@can('job_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.jobs.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.job.title_singular') }} {{ trans('global.list') }}
        @can('job_fetch')
        <a href="{{ route("manataljobs") }}"  class="btn btn-primary ">Fetch Jobs</a>
        @endcan
    </div>

    <div class="card-body">
       
                    @foreach($jobs as $key => $job)

                        <div class="joblist card" data-entry-id="{{ $job->id }}">
                       <!--  <div class="card-header">
                        Featured
                        </div> -->
                        <div class="card-body">
                        <div class="card-details">
                        <h5 class="card-title"> {{ $job->title ?? '' }} - {{ str_replace('_',' ',ucwords($job->job_nature)) ?? '' }}  {{ $job->is_remote == 1 ? ' - Remote' : ''}}</h5>

                        <p class="card-text"> {{ $job->address ?? '' }} {{ $job->salary_min ?? '' }} {{ $job->salary_min  ? '-' : '' }}  {{ $job->salary_max ?? '' }} {{ $job->salary_min ? $job->currency : '' }} {{ str_replace('_',' ',ucwords($job->status)) ?? '' }}</p>
                        <div class="card-footerend">
                          <div class="card-footerlinks">
                           @can('job_show')
                                    <a class="" href="{{ route('admin.jobs.show', $job->id) }}">
                                        Job Description
                                    </a>
                            @endcan
                             <a class="" href="{{ route('admin.jobs.show', $job->id) }}">
                                       Candidate pipeline
                                    </a>
                            
                             @if($job->career_page_url)
                          <a href="{{ $job->career_page_url }}" > Career Page </a>
                          @endif
                           @can('job_edit')
                                    <a class="" href="{{ route('admin.jobs.edit', $job->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                            @can('job_delete')
                                    <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-primary" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                         </div>
                          
                          @can('job_candidate_add_allow')
                            <button type="button" class="openModal btn btn-primary" data-toggle="modal" data-id="{{$job->id}}">
                            Submit Candidate
                            </button>
                          @endcan
                      </div>
                    </div>
                    <div class="discount">
                        <h5 class="card-title">Direct Hire</h5>
                        <div class="card-text"> 
                         <p> Your reward</p>
                          <span>10%</span>
                <p>of base salary 
                <br>Estimate: $8,050 </p>
<p>Guarantee period: 90 days</p></div>
                    </div>
                        </div>
                        </div>
                    
                    @endforeach
            
        </div>

       

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
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
                <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Full Name" >
                <span id="full_name_error"></span>
                <input type="hidden" name="job_id" id="job_id">
            </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email*</label>
             <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" >
          </div>
          <div class="form-group">
            <label for="phone_number" class="col-form-label">Phone Number*</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number" >
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Gender</label>
                <input type="radio" name="gender" value="Male" checked>Male
                 <input type="radio" name="gender" value="Female">Female
          </div>
           <div class="form-group">
            <label for="birth_date" class="col-form-label">Birth of Date*</label>
               <input type="date" name="birth_date" id="birth_date" class="form-control" placeholder="Enter Birth Date" >
          </div>
            <div class="form-group">
            <label for="address" class="col-form-label">Address*</label>
               <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" >
            </div>
             <div class="form-group">
            <label for="zipcode" class="col-form-label">Zipcode*</label>
               <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Enter zipcode" >
            </div>
            <div class="form-group">
            <label for="hourly_rate" class="col-form-label">Hourly Rate*</label>
             <input type="text" name="hourly_rate" id="hourly_rate" class="form-control" placeholder="Enter Hourly Rate" >
            </div>
              <div class="form-group">
            <label for="zipcode" class="col-form-label">Upload CV</label>
               <input type="file" accept="application/pdf, document/*" name="cv" id="cv" class="form-control" >
            </div>
             <div class="form-group">
            <label for="zipcode" class="col-form-label">Upload Document</label>
              <input type="file" accept="application/pdf, document/*" name="document" id="document" class="form-control" >
            </div>
             
      </div>
      <div class="modal-footer">
                <button class="btn btn-primary btn_save">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>



@endsection
@section('scripts')
@parent

<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('job_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.jobs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Job:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

    $(".openModal").click(function(){
        var job_id = $(this).attr("data-id");
        $("#job_id").val(job_id);
        $('#myModal').modal('show'); 

    });
    $(".close").click(function() {
        $('#myModal').hide();
    });

    $(".btn_save").click(function(event) {
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

        // if(full_name!="" && email!="" && phone_number!="" && address!="" && zipcode!="" && birth_date!="" && job_id != "" && hourly_rate!="" && cv!="" && document_file!="") {
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
                //alert(result.msg);
                if(result.success == 1){
                  console.log(result.msg);
                  location.reload();
                } else{
                   console.log(result.msg); 
                   $(".error_group").show();
                   $(".error_group").empty(); 
                   $.each(result.msg, function (fieldName, errorBag) {
                        let errorMessages = '';
                        $.each(errorBag, function(i, message) {
                            // if(message == 'Please enter valid email' || message == 'Please enter valid phone number' || message == 'Please enter only digits in phone' || message == 'Please enter 10 digits in phone' || message == 'Please enter only digit in zipcode' || message == 'Please upload only Doc or PDF file in document' || message == 'Maximum file size to upload is 8MB (10 MB) in document' || message == 'Please upload only Doc or PDF file in cv' || message == 'Maximum file size to upload is 8MB (10 MB) in cv'){
                            //     errorMessages += message+'<br>';    
                            // }
                            errorMessages += message+'<br>';    
                        });
                        $(".error_group").append(errorMessages);
                        //setTimeout(function(){ $(".error_group").hide() }, 3000);
                    }); 
                }
              }
            });    
      //  }

        
    });

</script>

<!-- Button trigger modal -->

@endsection