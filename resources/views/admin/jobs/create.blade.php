@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.job.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.jobs.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('external_id') ? 'has-error' : '' }}">
                <label for="external_id">{{ trans('cruds.job.fields.external_id') }}*</label>
                <input type="text" id="external_id" name="external_id" class="form-control" value="{{ old('external_id', isset($job) ? $job->external_id : '') }}" required>
                @if($errors->has('external_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('external_id') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.external_id_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('job_id') ? 'has-error' : '' }}">
                <label for="job_id">{{ trans('cruds.job.fields.job_id') }}*</label>
                <input type="text" id="job_id" name="job_id" class="form-control" value="{{ old('job_id', isset($job) ? $job->job_id : '') }}" required>
                @if($errors->has('job_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('job_id') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.job_id_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.job.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($job) ? $job->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }}">
                <label for="company">{{ trans('cruds.job.fields.company') }}*</label>
                <select name="company_id" id="company" class="form-control select2" required>
                    @foreach($companies as $id => $company)
                        <option value="{{ $id }}" {{ (isset($job) && $job->company ? $job->company->id : old('company_id')) == $id ? 'selected' : '' }}>{{ $company }}</option>
                    @endforeach
                </select>
                @if($errors->has('company_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('company_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('industry') ? 'has-error' : '' }}">
                <label for="industry">{{ trans('cruds.job.fields.industry') }}*</label>
                <input type="text" id="industry" name="industry" class="form-control" value="{{ old('industry', isset($job) ? $job->industry : '') }}" required>
                @if($errors->has('industry'))
                    <em class="invalid-feedback">
                        {{ $errors->first('industry') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.industry_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('organization') ? 'has-error' : '' }}">
                <label for="organization">{{ trans('cruds.job.fields.organization') }}*</label>
                <input type="text" id="organization" name="organization" class="form-control" value="{{ old('organization', isset($job) ? $job->organization : '') }}" required>
                @if($errors->has('organization'))
                    <em class="invalid-feedback">
                        {{ $errors->first('organization') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.organization_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('headcount') ? 'has-error' : '' }}">
                <label for="headcount">{{ trans('cruds.job.fields.headcount') }}*</label>
                <input type="text" id="headcount" name="headcount" class="form-control" value="{{ old('headcount', isset($job) ? $job->headcount : '') }}" required>
                @if($errors->has('headcount'))
                    <em class="invalid-feedback">
                        {{ $errors->first('headcount') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.headcount_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('creator') ? 'has-error' : '' }}">
                <label for="creator">{{ trans('cruds.job.fields.creator') }}*</label>
                <input type="text" id="creator" name="creator" class="form-control" value="{{ old('creator', isset($job) ? $job->creator : '') }}" required>
                @if($errors->has('creator'))
                    <em class="invalid-feedback">
                        {{ $errors->first('creator') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.creator_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('owner') ? 'has-error' : '' }}">
                <label for="owner">{{ trans('cruds.job.fields.owner') }}*</label>
                <input type="text" id="owner" name="owner" class="form-control" value="{{ old('owner', isset($job) ? $job->owner : '') }}" required>
                @if($errors->has('owner'))
                    <em class="invalid-feedback">
                        {{ $errors->first('owner') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.owner_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                <label for="short_description">{{ trans('cruds.job.fields.short_description') }}</label>
                <input type="text" id="short_description" name="short_description" class="form-control" value="{{ old('short_description', isset($job) ? $job->short_description : '') }}">
                @if($errors->has('short_description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('short_description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.short_description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('full_description') ? 'has-error' : '' }}">
                <label for="full_description">{{ trans('cruds.job.fields.full_description') }}</label>
                <textarea id="full_description" name="full_description" class="form-control ">{{ old('full_description', isset($job) ? $job->full_description : '') }}</textarea>
                @if($errors->has('full_description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('full_description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.full_description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('requirements') ? 'has-error' : '' }}">
                <label for="requirements">{{ trans('cruds.job.fields.requirements') }}</label>
                <textarea id="requirements" name="requirements" class="form-control ">{{ old('requirements', isset($job) ? $job->requirements : '') }}</textarea>
                @if($errors->has('requirements'))
                    <em class="invalid-feedback">
                        {{ $errors->first('requirements') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.requirements_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('job_nature') ? 'has-error' : '' }}">
                <label for="job_nature">{{ trans('cruds.job.fields.job_nature') }}</label>
                <input type="text" id="job_nature" name="job_nature" class="form-control" value="{{ old('job_nature', isset($job) ? $job->job_nature : 'Full-time') }}">
                @if($errors->has('job_nature'))
                    <em class="invalid-feedback">
                        {{ $errors->first('job_nature') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.job_nature_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('location_id') ? 'has-error' : '' }}">
                <label for="location">{{ trans('cruds.job.fields.location') }}*</label>
                <select name="location_id" id="location" class="form-control select2" required>
                    @foreach($locations as $id => $location)
                        <option value="{{ $id }}" {{ (isset($job) && $job->location ? $job->location->id : old('location_id')) == $id ? 'selected' : '' }}>{{ $location }}</option>
                    @endforeach
                </select>
                @if($errors->has('location_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('location_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address">{{ trans('cruds.job.fields.address') }}</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($job) ? $job->address : '') }}">
                @if($errors->has('address'))
                    <em class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.address_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('zipcode') ? 'has-error' : '' }}">
                <label for="zipcode">{{ trans('cruds.job.fields.zipcode') }}</label>
                <input type="text" id="zipcode" name="zipcode" class="form-control" value="{{ old('zipcode', isset($job) ? $job->zipcode : '') }}">
                @if($errors->has('zipcode'))
                    <em class="invalid-feedback">
                        {{ $errors->first('zipcode') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.zipcode_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
                <label for="categories">{{ trans('cruds.job.fields.categories') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="categories[]" id="categories" class="form-control select2" multiple="multiple">
                    @foreach($categories as $id => $categories)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || isset($job) && $job->categories->contains($id)) ? 'selected' : '' }}>{{ $categories }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <em class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.categories_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('salary') ? 'has-error' : '' }}">
                <label for="salary">{{ trans('cruds.job.fields.salary') }}*</label>
                <input type="text" id="salary" name="salary" class="form-control" value="{{ old('salary', isset($job) ? $job->salary : '') }}" required>
                @if($errors->has('salary'))
                    <em class="invalid-feedback">
                        {{ $errors->first('salary') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.salary_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('salary_min') ? 'has-error' : '' }}">
                <label for="salary_min">{{ trans('cruds.job.fields.salary_min') }}*</label>
                <input type="text" id="salary_min" name="salary_min" class="form-control" value="{{ old('salary_min', isset($job) ? $job->salary_min : '') }}" required>
                @if($errors->has('salary_min'))
                    <em class="invalid-feedback">
                        {{ $errors->first('salary_min') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.salary_min_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('salary_max') ? 'has-error' : '' }}">
                <label for="salary_max">{{ trans('cruds.job.fields.salary_max') }}*</label>
                <input type="text" id="salary_max" name="salary_max" class="form-control" value="{{ old('salary_max', isset($job) ? $job->salary_max : '') }}" required>
                @if($errors->has('salary_max'))
                    <em class="invalid-feedback">
                        {{ $errors->first('salary_max') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.salary_max_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('currency') ? 'has-error' : '' }}">
                <label for="currency">{{ trans('cruds.job.fields.currency') }}*</label>
                <input type="text" id="currency" name="currency" class="form-control" value="{{ old('currency', isset($job) ? $job->currency : '') }}" required>
                @if($errors->has('currency'))
                    <em class="invalid-feedback">
                        {{ $errors->first('currency') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.currency_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('is_remote') ? 'has-error' : '' }}">
                <label for="is_remote">{{ trans('cruds.job.fields.is_remote') }}</label>
                <input name="is_remote" type="hidden" value="0">
                <input value="1" type="checkbox" id="is_remote" name="is_remote" {{ old('is_remote', 0) == 1 ? 'checked' : '' }}>
                @if($errors->has('is_remote'))
                    <em class="invalid-feedback">
                        {{ $errors->first('is_remote') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.is_remote_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('is_published') ? 'has-error' : '' }}">
                <label for="is_published">{{ trans('cruds.job.fields.is_published') }}</label>
                <input name="is_published" type="hidden" value="0">
                <input value="1" type="checkbox" id="is_published" name="is_published" {{ old('is_published', 0) == 1 ? 'checked' : '' }}>
                @if($errors->has('is_published'))
                    <em class="invalid-feedback">
                        {{ $errors->first('is_published') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.is_published_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">{{ trans('cruds.job.fields.status') }}*</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ old('status', isset($job) ? $job->status : '') }}" required>
                @if($errors->has('status'))
                    <em class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.status_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('career_page_url') ? 'has-error' : '' }}">
                <label for="career_page_url">{{ trans('cruds.job.fields.career_page_url') }}*</label>
                <input type="text" id="career_page_url" name="career_page_url" class="form-control" value="{{ old('career_page_url', isset($job) ? $job->career_page_url : '') }}" required>
                @if($errors->has('career_page_url'))
                    <em class="invalid-feedback">
                        {{ $errors->first('career_page_url') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.career_page_url_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('is_pinned_in_career_page') ? 'has-error' : '' }}">
                <label for="is_pinned_in_career_page">{{ trans('cruds.job.fields.is_pinned_in_career_page') }}</label>
                <input name="is_pinned_in_career_page" type="hidden" value="0">
                <input value="1" type="checkbox" id="is_pinned_in_career_page" name="is_pinned_in_career_page" {{ (isset($job) && $job->is_pinned_in_career_page) || old('is_pinned_in_career_page', 0) === 1 ? 'checked' : '' }}>
                @if($errors->has('is_pinned_in_career_page'))
                    <em class="invalid-feedback">
                        {{ $errors->first('is_pinned_in_career_page') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.is_pinned_in_career_page_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('top_rated') ? 'has-error' : '' }}">
                <label for="top_rated">{{ trans('cruds.job.fields.top_rated') }}</label>
                <input name="top_rated" type="hidden" value="0">
                <input value="1" type="checkbox" id="top_rated" name="top_rated" {{ old('top_rated', 0) == 1 ? 'checked' : '' }}>
                @if($errors->has('top_rated'))
                    <em class="invalid-feedback">
                        {{ $errors->first('top_rated') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.job.fields.top_rated_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection