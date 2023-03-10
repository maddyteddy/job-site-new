@extends('layouts.admin')
@section('content')
@can('myjob_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <!--<a class="btn btn-success" href="{{ route("admin.myjobs.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.myjob.title_singular') }}
            </a>-->
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.myjob.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-myjob">
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
                            {{ trans('cruds.job.fields.job_nature') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.address') }}
                        </th>
                       
                        <th>
                            {{ trans('cruds.job.fields.salary') }}
                        </th>
                           <th>
                            {{ trans('cruds.job.fields.status') }}
                        </th>
                         <th>
                            {{ trans('cruds.job.fields.career_page_url') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $key => $myjob)
                        <tr data-entry-id="{{ $myjob->id }}">
                          <td>

                            </td>
                            <td>
                                {{ $myjob->id ?? '' }}
                            </td>
                            <td>
                                {{ $myjob->title ?? '' }}
                            </td>
                             <td>
                                {{ str_replace('_',' ',ucwords($myjob->job_nature)) ?? '' }}
                            </td>
                            <td>
                                {{ $myjob->address ?? '' }}
                            </td>
                           
                            <td>
                                {{ $myjob->salary_min ?? '' }} {{ $myjob->salary_min  ? '-' : '' }}  {{ $myjob->salary_max ?? '' }} {{ $myjob->salary_min ? $myjob->currency : '' }}
                            </td>
                               <td>
                                {{ ucwords($myjob->status) ?? '' }}
                            </td>
                             <td>
                               @if($myjob->career_page_url)
                                <a href="{{ $myjob->career_page_url }}" > Career Page </a>
                               @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.myjobs.show', $myjob->id) }}">
                                        View
                                </a>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.myjobs.viewCandidate', $myjob->id) }}">
                                        View Candidate
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        

    </div>
</div>



@endsection
@section('scripts')
@parent

<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-myjob:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

    

    

</script>
@endsection