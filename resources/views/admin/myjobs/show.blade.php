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
                            {{ trans('cruds.myjob.fields.external_id') }}
                        </th>
                        <td>
                            {{ $myjob->external_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.job_id') }}
                        </th>
                        <td>
                            {{ $myjob->job_id }}
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
                            {{ trans('cruds.myjob.fields.industry') }}
                        </th>
                        <td>
                            {{ $myjob->company->industry ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.organization') }}
                        </th>
                        <td>
                            {{ $myjob->organization ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.headcount') }}
                        </th>
                        <td>
                            {{ $myjob->headcount ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.creator') }}
                        </th>
                        <td>
                            {{ $myjob->creator ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.owner') }}
                        </th>
                        <td>
                            {{ $myjob->owner ?? '' }}
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
                            {{ trans('cruds.myjob.fields.job_nature') }}
                        </th>
                        <td>
                            {{ $myjob->job_nature }}
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
                            {{ $myjob->address }} {{ $myjob->zipcode }}
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
                            {{ $myjob->salary }} {{ $myjob->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.salary_min') }}
                        </th>
                        <td>
                            {{ $myjob->salary_min }} {{ $myjob->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.salary_max') }}
                        </th>
                        <td>
                            {{ $myjob->salary_max }} {{ $myjob->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.is_remote') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled {{ $myjob->is_remote ? "checked" : "" }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.is_published') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled {{ $myjob->is_published ? "checked" : "" }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.status') }}
                        </th>
                        <td>
                            {{ $myjob->status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.career_page_url') }}
                        </th>
                        <td>
                            <a href="{{ $myjob->career_page_url ?? '' }}" target="_blank">{{ $myjob->career_page_url ?? '' }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myjob.fields.is_pinned_in_career_page') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled {{ $myjob->is_pinned_in_career_page ? "checked" : "" }}>
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