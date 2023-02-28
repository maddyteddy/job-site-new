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
        {{ trans('cruds.candidate.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-myjob">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.birth_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.zipcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.candidate.fields.created_at') }}
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($listCandidate as $key => $candidate)
                        <tr data-entry-id="{{ $candidate->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $candidate->id ?? '' }}
                            </td>
                            <td>
                                {{ $candidate->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $candidate->email ?? '' }}
                            </td>
                            <td>
                                {{ $candidate->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $candidate->gender ?? '' }}
                            </td>
                            <td>
                                {{ $candidate->birth_date ?? '' }}
                            </td>
                            <td>
                                {{ $candidate->address ?? '' }}
                            </td>
                            <td>
                                {{ $candidate->zipcode ?? '' }}
                            </td>
                            <td>
                                {{ $candidate->created_at ?? '' }}
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