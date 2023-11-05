@php
    $action = ($type == 'edit') ? route('forms.update', $form->code) : route('forms.store');
    $title = ($type == 'edit') ? $form->title : '';
    $description = ($type == 'edit') ? str_convert_line_breaks($form->description, false) : '';
@endphp
@section('plugin-css')
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet">
@endsection
<form id="forms" method="post" action="{{ $action }}" autocomplete="off">
    @if ($type == 'edit') @method('PUT') @endif
    @csrf
    <label>
        <p class="label-txt">Form Title</p>
        <input type="text" class="input" id="title" name="title" placeholder="Form Title" value="{{ old('title') ?: $title }}" required>
        <div class="line-box">
            <div class="line"></div>
        </div>
        @if ($errors->has('title'))
            <span class="invalid-feedback">{{ $errors->first('title') }}</span>
        @endif
    </label>
    <label>
        <p class="label-txt">Form Description</p>
        <textarea rows="2" cols="5" class="input" id="description" name="description" required>{{ old('description') ?: $description }}</textarea>
        @if ($errors->has('description'))
            <span class="help-block">{{ $errors->first('description') }}</span>
        @endif
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>

    <button type="submit" class="btn btn-{{ ($type == 'edit') ? 'dark' : 'info' }}">{{ ($type == 'edit') ? 'Update' : 'Create' }}</button>
</form>

