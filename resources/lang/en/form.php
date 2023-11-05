<?php
use Illuminate\Support\Carbon;
$now = Carbon::now();

$short_answer_sub_template = <<<SUB_TEMPLATE
	<div class="card template short-answer" id="" data-attribute-type="single">
    <div class="card-body mb-3">
        <div class="form-group">
            <div class="mb-3">
                <input type="text" class="form-control form-control-lg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
            </div>
            <input type="text" class="form-control" value="Short Answer" readonly>
        </div>
    </div>
    <div class="card-footer card-footer-bordered">
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-semibold">Short Answer Question Type</span>
            <div class="d-flex">
                <div class="form-group">
                    <label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
                        <input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
                        Required
                    </label>
                </div>
                <button type="button" class="btn btn-danger btn-sm question-delete ml-5" data-form="" data-form-field=""><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>
SUB_TEMPLATE;

$short_answer_main_template = <<<MAIN_TEMPLATE
	<div class="row template short-answer">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Short Answer Question:</span></label>
				<input type="text" class="form-control" id="" name="" placeholder="Answer" value="" maxlength="255" minlength="3">
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$long_answer_sub_template = <<<SUB_TEMPLATE
	<div class="card template long-answer" id="" data-attribute-type="single">
    <div class="card-body mb-3">
        <div class="form-group">
            <div class="mb-3">
                <input type="text" class="form-control form-control-lg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
            </div>
            <input type="text" class="form-control" value="Long Answer" readonly>
        </div>
    </div>
    <div class="card-footer card-footer-bordered">
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-semibold">Long Answer Question Type</span>
            <div class="d-flex">
                <div class="form-group">
                    <label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
                        <input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
                        Required
                    </label>
                </div>
                <button type="button" class="btn btn-danger btn-sm question-delete ml-5" data-form="" data-form-field=""><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>
SUB_TEMPLATE;

$long_answer_main_template = <<<MAIN_TEMPLATE
	<div class="row template long-answer">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Long Answer Question:</span></label>
				<textarea rows="1" cols="5" class="form-control elastic" id="" name="" placeholder="Answer" maxlength="30000" data-rule-min-words="3"></textarea>
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$multiple_choices_sub_template = <<<SUB_TEMPLATE
	<div class="card template multiple-choices" id="" data-attribute-type="multiple">
        <div class="card-body mb-3">
            <div class="form-group mb-3">
                <input type="text" class="form-control form-control-lg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-check-circle"></i>
                            </span>
                            <input type="text" id="" name="" class="form-control question-option" placeholder="Option 1" maxlength="255" minlength="3" required>
                            <span class="input-group-addon">
                                <button type="button" class="btn btn-sm btn-info add-option">Add Option</button>
                            </span>
                        </div>
                    </div>
                    <div class="options-wrapper">
                        <div class="form-group mb-3 d-none hidden" id="">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-check-circle"></i>
                                </span>
                                <input type="text" id="" class="form-control question-option" placeholder="Option" disabled>
                                <span class="input-group-text">
                                    <button type="button" class="btn btn-sm btn-secondary remove-option"><i class="fa fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer card-footer-bordered">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-semibold">Multiple Choices Question Type</span>
                <div class="d-flex">
                    <div class="form-group">
                        <label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
                            <input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
                            Required
                        </label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm question-delete ml-5" data-form="" data-form-field=""><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>

SUB_TEMPLATE;

$multiple_choices_main_template = <<<MAIN_TEMPLATE
	<div class="row template multiple-choices">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Multiple Choice Question:</span></label>
				<div class="options button radios">
					<div class="radio mt-15 mb-15 sample">
						<label class="option-label">
							<input type="radio" name="name" id="" class="styled"> <span class="option">Option 1</span>
						</label>
					</div>
				</div>
		    </div>
	    </div>
    </div>
MAIN_TEMPLATE;

$checkboxes_sub_template = <<<SUB_TEMPLATE
	<div class="card template checkboxes" id="" data-attribute-type="multiple">
        <div class="card-body mb-3">
            <div class="form-group mb-3">
                <input type="text" class="form-control form-control-lg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
            </div>
            <div class="row has-options">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-check-square"></i>
                            </span>
                            <input type="text" id="" name="" class="form-control question-option" placeholder="Option 1" maxlength="255" minlength="3" required>
                            <span class="input-group-addon">
                                <button type="button" class="btn btn-sm btn-info add-option">Add Option</button>
                            </span>
                        </div>
                    </div>
                    <div class="options-wrapper">
                        <div class="form-group mb-3 d-none hidden" id="">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-check-square"></i>
                                </span>
                                <input type="text" id="" class="form-control question-option" placeholder="Option" disabled>
                                <span class="input-group-addon">
                                    <button type="button" class="btn btn-sm btn-default remove-option"><i class="fa fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer card-footer-bordered">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-semibold">Checkboxes Question Type</span>
                <div class="d-flex">
                    <div class="form-group">
                        <label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
                            <input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
                            Required
                        </label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm question-delete ml-5" data-form="" data-form-field=""><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
SUB_TEMPLATE;

$checkboxes_main_template = <<<MAIN_TEMPLATE
	<div class="row template checkboxes">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Checkbox Question:</span></label>
				<div class="options button checkboxes">
					<div class="checkbox mt-15 mb-15">
						<label>
							<input type="checkbox" class="styled" name=""> <span class="option">Option 1</span>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$drop_down_sub_template = <<<SUB_TEMPLATE
	<div class="card template drop-down" id="" data-attribute-type="multiple">
        <div class="card-body mb-3">
            <div class="form-group mb-3">
                <input type="text" class="form-control form-control-lg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
            </div>
            <div class="row has-options">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-addon" data-sn="1" id="">
                                1.
                            </span>
                            <input type="text" id="" name="" class="form-control question-option" placeholder="Option 1" maxlength="255" minlength="3" required>
                            <span class="input-group-addon no-padding-bottom">
                                <button type="button" class="btn btn-sm btn-default add-option">Add Option</button>
                            </span>
                        </div>
                    </div>
                    <div class="options-wrapper">
                        <div class="form-group mb-3 d-none hidden" id="">
                            <div class="input-group">
                                <span class="input-group-addon" data-sn="2" id="">
                                    2.
                                </span>
                                <input type="text" id="" class="form-control question-option" placeholder="Option" disabled>
                                <span class="input-group-addon no-padding-bottom">
                                    <button type="type" class="btn btn-sm btn-default remove-option"><i class="fa fa-times"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer card-footer-bordered">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-semibold">Drop Down Question Type</span>
                <div class="d-flex">
                    <div class="form-group">
                        <label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
                            <input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
                            Required
                        </label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm question-delete ml-5" data-form="" data-form-field=""><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
SUB_TEMPLATE;

$drop_down_main_template = <<<MAIN_TEMPLATE
	<div class="row template drop-down">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Drop Down Question:</span></label>
				<div class="options select">
					<select class="select" name="" data-width="100%">
					</select>
				</div>
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$date_sub_template = <<<SUB_TEMPLATE
	<div class="card template date" id="" data-attribute-type="single">
        <div class="card-body mb-3">
            <div class="form-group">
                <div class="mb-3">
                    <input type="text" class="form-control form-control-lg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
                </div>
                <div class="input-group col-md-6">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Day, Month, Year" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer card-footer-bordered">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-semibold">Date Question Type</span>
                <div class="d-flex">
                    <div class="form-group">
                        <label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
                            <input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
                            Required
                        </label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm question-delete ml-5" data-form="" data-form-field=""><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
SUB_TEMPLATE;

$current_date = $now->format('jS, F Y');
$date_main_template = <<<MAIN_TEMPLATE
	<div class="row template date">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Date Question:</span></label>
				<input type="date" name="" class="form-control pickadate" value="" placeholder="$current_date" data-msg="Date is required">
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

$time_sub_template = <<<SUB_TEMPLATE
	<div class="card template time" id="" data-attribute-type="single">
        <div class="card-body mb-3">
            <div class="form-group">
                <div class="mb-3">
                    <input type="text" class="form-control form-control-lg question-name" id="" name="" placeholder="Question" maxlength="255" minlength="3" required>
                </div>
                <div class="input-group col-md-6">
                    <span class="input-group-text">
                        <i class="fa fa-clock"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Time" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer card-footer-bordered">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-semibold">Time Question Type</span>
                <div class="d-flex">
                    <div class="form-group">
                        <label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm">
                            <input type="checkbox" class="switchery question-required" name="" id="" checked="checked">
                            Required
                        </label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm question-delete ml-5" data-form="" data-form-field=""><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
SUB_TEMPLATE;

$current_time = $now->format('h:i A');
$time_main_template = <<<MAIN_TEMPLATE
	<div class="row template time">
		<div class="col-md-12">
			<div class="form-group">
				<label for="" class="label-xlg field-label"><span class="question">Time Question:</span></label>
				<input type="time" class="form-control pickatime" placeholder="$current_time">
			</div>
		</div>
	</div>
MAIN_TEMPLATE;

return [
	[
		'name' => 'Short Answer',
		'alias' => 'short-answer',
		'sub_template' => $short_answer_sub_template,
		'main_template' => $short_answer_main_template,
		'attribute_type' => 'string',
	],
	[
		'name' => 'Long Answer',
		'alias' => 'long-answer',
		'sub_template' => $long_answer_sub_template,
		'main_template' => $long_answer_main_template,
		'attribute_type' => 'string',
	],
	[
		'name' => 'Multiple Choice',
		'alias' => 'multiple-choices',
		'sub_template' => $multiple_choices_sub_template,
		'main_template' => $multiple_choices_main_template,
		'attribute_type' => 'array',
	],
	[
		'name' => 'Chechboxes',
		'alias' => 'checkboxes',
		'sub_template' => $checkboxes_sub_template,
		'main_template' => $checkboxes_main_template,
		'attribute_type' => 'array',
	],
	[
		'name' => 'Drop-down',
		'alias' => 'drop-down',
		'sub_template' => $drop_down_sub_template,
		'main_template' => $drop_down_main_template,
		'attribute_type' => 'array',
	],
	[
		'name' => 'Date',
		'alias' => 'date',
		'sub_template' => $date_sub_template,
		'main_template' => $date_main_template,
		'attribute_type' => 'string',
	],
	[
		'name' => 'Time',
		'alias' => 'time',
		'sub_template' => $time_sub_template,
		'main_template' => $time_main_template,
		'attribute_type' => 'string',
	],
];
