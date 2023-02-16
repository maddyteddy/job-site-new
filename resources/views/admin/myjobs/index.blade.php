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
                            {{ trans('cruds.myjob.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.myjob.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.myjob.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.myjob.fields.short_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.myjob.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.myjob.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.myjob.fields.categories') }}
                        </th>
                        <th>
                            {{ trans('cruds.myjob.fields.salary') }}
                        </th>
                        <th>
                            {{ trans('cruds.myjob.fields.top_rated') }}
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
                                {{ $myjob->company->name ?? '' }}
                            </td>
                            <td>
                                {{ $myjob->short_description ?? '' }}
                            </td>
                            <td>
                                {{ $myjob->location->name ?? '' }}
                            </td>
                            <td>
                                {{ $myjob->address ?? '' }}
                            </td>
                            <td>
                                @foreach($myjob->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $myjob->salary ?? '' }}
                            </td>
                            <td>
                                {{ $myjob->top_rated ? trans('global.yes') : trans('global.no') }}
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
@can('myjob_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.myjobs.massDestroy') }}",
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
  $('.datatable-myjob:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

    

    

</script>
@endsection