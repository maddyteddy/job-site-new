@extends('layouts.admin')
@section('content')
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
        <a href="{{ route("manataljobs") }}"  class="btn btn-primary btn_save">Fetch Jobs</a>
        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Job">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.job.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.short_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.categories') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.salary') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.top_rated') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $key => $job)
                        <tr data-entry-id="{{ $job->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $job->id ?? '' }}
                            </td>
                            <td>
                                {{ $job->title ?? '' }}
                            </td>
                            <td>
                                {{ $job->company->name ?? '' }}
                            </td>
                            <td>
                                {{ $job->short_description ?? '' }}
                            </td>
                            <td>
                                {{ $job->location->name ?? '' }}
                            </td>
                            <td>
                                {{ $job->address ?? '' }}
                            </td>
                            <td>
                                @foreach($job->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $job->salary ?? '' }}
                            </td>
                            <td>
                                {{ $job->top_rated ? trans('global.yes') : trans('global.no') }}
                            </td>
                            <td>
                                @can('job_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.jobs.show', $job->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('job_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.jobs.edit', $job->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('job_delete')
                                    <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                                @can('job_candidate_add_allow')
                                <button type="button" class="openModal btn btn-xs btn-primary" data-toggle="modal" data-id="{{$job->id}}">
                                Add Candidate
                                </button>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                <div class="form-group">
                    <label for="full_name" class="col-form-label">Enter Full Name</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Full Name">
                    <input type="hidden" name="job_id" id="job_id">
                </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
             <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
          </div>
          <div class="form-group">
            <label for="phone_number" class="col-form-label">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number">
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Gender:</label>
                <input type="radio" name="gender" value="Male">Male
                 <input type="radio" name="gender" value="Female">Female
          </div>
           <div class="form-group">
            <label for="birth_date" class="col-form-label">Birth of Date:</label>
               <input type="date" name="birth_date" id="birth_date" class="form-control" placeholder="Enter Birth Date">
          </div>
            <div class="form-group">
            <label for="address" class="col-form-label">Address:</label>
               <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
            </div>
             <div class="form-group">
            <label for="zipcode" class="col-form-label">Zipcode:</label>
               <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Enter zipcode">
            </div>
               <div class="form-group">
            <label for="hourly_rate" class="col-form-label">Hourly Rate:</label>
             <input type="text" name="hourly_rate" id="hourly_rate" class="form-control" placeholder="Enter Hourly Rate">
            </div>
              <div class="form-group">
            <label for="zipcode" class="col-form-label">Upload CV:</label>
               <input type="file" accept="application/pdf, document/*" name="cv" id="cv" class="form-control">
            </div>
             <div class="form-group">
            <label for="zipcode" class="col-form-label">Upload Document:</label>
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

    $(".btn_save").click(function() {
        var url =  "{{ route('admin.jobs.candidates') }}";
        var full_name = $("#full_name").val();
        var email = $("#email").val();
        var phone_number = $("#phone_number").val();
        var gender = $("#gender").val();
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
            }).done(function () { location.reload() })
    });

</script>

<!-- Button trigger modal -->

@endsection