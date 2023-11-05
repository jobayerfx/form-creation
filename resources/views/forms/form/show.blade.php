@php
	$page_data = [
		'has_sticky_sidebar' => true,
		'classes' => ['body' => ' sidebar-xs has-detached-right']
    ];

    $fields = $form->fields;

    $current_user = auth()->user();
@endphp

@extends('layouts.app', $page_data)

@section('title', "My Forms | {$form->title}")

@section('content')

@include('partials.alert', ['name' => 'show'])


<div class="card card-flat">
    <div class="card-header d-flex justify-content-between">
        @php $symbol = $form::getStatusSymbols()[$form->status]; @endphp
        <h5 class="card-title">{{ $form->title }} <span class="badge bg-{{ $symbol['color'] }} rounded-pill">{{ $symbol['label'] }}</span></h5>
        <div class="d-flex justify-content-end">
            @include('forms.partials._form-menu')
        </div>
    </div>
    <div class="card-body">
        {!! str_convert_line_breaks($form->description) !!}
    </div>
</div>

<div class="alert alert-success">
    <strong>Message!</strong> In order to create a form, <a href="#" class="alert-link">you need to click on any on the question type in the presentation section (right sidebar) below. Please ensure that you fill in the appropriate field before submitting.</a>.
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-9">
            <div class="container">
                <div class="content">
                    <form id="create-form" action="{{ route('forms.draft', $form->code) }}" method="post" autocomplete="off">
                        @csrf
                        <div class="questions">
                            @php $formatted_fields = []; @endphp
                            @if ($fields->count())
                                @foreach ($fields as $field)
                                    <div class="filled" data-id="{{ $field->id }}" data-attribute="{{ $field->attribute }}">
                                        @php $template = get_form_templates($field->template) @endphp
                                        {!! $template['sub_template'] !!}
                                    </div>
                                    @php
                                        $only_attributes = ['attribute', 'template', 'question', 'required', 'options'];
                                        if ($template['attribute_type'] === 'array') {
                                            $only_attributes[] = 'options';
                                        }
                                        $formatted_fields[$field->attribute] = $field->only($only_attributes);
                                    @endphp
                                @endforeach
                            @endif
                        </div>

                        <div class="card card-body submit d-none">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success mr-5" id="submit" data-loading-text="Saving..." data-complete-text="Save">Save</button>
                                @php $form_is_ready = in_array($form->status, [$form::STATUS_PENDING, $form::STATUS_OPEN, $form::STATUS_CLOSED]); @endphp
                                <a href="{{ ($form_is_ready) ? route('forms.preview', $form->code) : 'javascript:void(0)' }}" class="btn btn-primary {{ ($form_is_ready) ? '' : ' d-none' }}" target="_blank" id="form-preview">Preview</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="sidebar-detached">
                <div class="sidebar sidebar-default">
                    <div class="sidebar-content">
                        <div class="sidebar-category">
                            <div class="category-title">
                                <span>Presentation</span>
                                <i class="fa fa-list">
                                </i>
                            </div>

                            <div class="category-content no-padding">
                                <ul class="navigation navigation-alt navigation-accordion" data-form="{{ $form->code }}">
                                    <li class="navigation-header">Select a Question Type</li>
                                    <li><a  class="question-template" data-id="short-answer"><i class="fa fa-minus"></i> Short Answer</a></li>
                                    <li><a  class="question-template" data-id="long-answer"><i class="fa fa-text-width"></i> Long Answer</a></li>
                                    <li class="navigation-divider"></li>
                                    <li><a  class="question-template" data-id="multiple-choices"><i class="fa fa-check-circle-o"></i> Multiple Choice</a></li>
                                    <li><a  class="question-template" data-id="checkboxes"><i class="fa fa-check-square"></i> Chechboxes</a></li>
                                    <li><a  class="question-template" data-id="drop-down"><i class="fa fa-chevron-down"></i> Drop-down</a></li>
                                    <li class="navigation-divider"></li>
                                    <li><a  class="question-template" data-id="date"><i class="fa fa-calendar"></i> Date</a></li>
                                    <li><a  class="question-template" data-id="time"><i class="fa fa-clock-o"></i> Time</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>





@endsection

@section('plugin-scripts')
	<script src="{{ asset('assets/js/plugins/uniform.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/autosize.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/noty.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap_select.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/validation/additional-methods.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/validation.js') }}"></script>
    <script src="{{ asset('assets/js/custom/detached-sticky.js') }}"></script>
    @include('forms.partials._script-show')
    @stack('script')
@endsection
