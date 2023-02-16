@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.myjob.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.id') }}
                        </th>
                        <td>
                            {{ $myjob->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.title') }}
                        </th>
                        <td>
                            {{ $myjob->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.company') }}
                        </th>
                        <td>
                            {{ $myjob->company->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.short_description') }}
                        </th>
                        <td>
                            {{ $myjob->short_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.full_description') }}
                        </th>
                        <td>
                            {!! $myjob->full_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.requirements') }}
                        </th>
                        <td>
                            {!! $myjob->requirements !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.myjob_nature') }}
                        </th>
                        <td>
                            {{ $myjob->myjob_nature }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.location') }}
                        </th>
                        <td>
                            {{ $myjob->location->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.address') }}
                        </th>
                        <td>
                            {{ $myjob->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Categories
                        </th>
                        <td>
                            @foreach($myjob->categories as $id => $categories)
                                <span class="label label-info label-many">{{ $categories->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.salary') }}
                        </th>
                        <td>
                            {{ $myjob->salary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.top_rated') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled {{ $myjob->top_rated ? "checked" : "" }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection