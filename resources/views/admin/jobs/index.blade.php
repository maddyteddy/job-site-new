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

                                    <a class="openModal" data-id="{{$job->id}}">Open Modal</a>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Add Details</h3>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
            @csrf    
            <div class="modal-body">

                <table>
                        <tr> 
                            <td> <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Full Name">
                            <input type="hidden" name="job_id" id="job_id">
                            </td>  
                        </tr>    
                        <tr> 
                            <td> <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                            </td>
                        </tr>
                        <tr> 
                            <td> 
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number">
                            </td>
                        </tr>
                        <tr> 
                            <td>
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            </td>    
                        </tr>
                        <tr> 
                            <td> <input type="date" name="birth_date" id="birth_date" class="form-control" placeholder="Enter Birth Date">
                            </td>
                        </tr>
                        <tr> 
                            <td> <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
                            </td>
                        </tr>
                        <tr> 
                            <td> <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Enter zipcode">
                            </td>
                        </tr>
                        <tr> 
                            <td></td>
                        </tr>
                        <tr> 
                            <td><input type="text" name="hourly_rate" id="hourly_rate" class="form-control" placeholder="Enter Hourly Rate"></td>
                        </tr>
                        <tr> 
                            <td><input type="file" accept="application/pdf, document/*" name="cv" id="cv" class="form-control">Upload CV</td>
                        </tr>
                        <tr> 
                            <td><input type="file" accept="application/pdf, document/*" name="document" id="document" class="form-control">Upload Document</td>
                        </tr>

                </table>
            </div>
            <div class="modal-footer">
                <button class="btn close" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary btn_save">Save changes</button>
            </div>
            </form>
        </div>
        <!-- Modal End -->

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
        
        var fd = new FormData();
        var files = $('#document')[0].files[0];
        fd.append('file', files);
        //alert(document_file);
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: url,
          data: { full_name: full_name, email:email, phone_number:phone_number,gender:gender,address:address, zipcode:zipcode, birth_date:birth_date, job_id:job_id, hourly_rate:hourly_rate, document_file:fd }})
          .done(function () { location.reload() })
    });

</script>
@endsection