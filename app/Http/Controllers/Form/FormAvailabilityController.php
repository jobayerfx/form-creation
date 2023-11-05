<?php

namespace App\Http\Controllers\Form;

use Auth;
use App\Models\Form;
use Validator;
use App\Models\FormAvailability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormAvailabilityController extends Controller
{
    public function save(Request $request, $form)
    {
        if ($request->ajax()) {
            $current_user = Auth::user();

            $form = Form::where('code', $form)->first();
            if (!$form || $form->user_id !== $current_user->id) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'not_found',
                    'error' => 'Form is invalid'
                ]);
            }

            if (empty(array_filter($request->except('_token'), function ($value) { return $value !== null; }))) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'validation_failed',
                    'error' => 'The form availability settings has to be filled',
                ]);
            }

            $request->merge([
                'open_form_time' => isset($request->open_form_time) ? "{$request->open_form_time}:00" : null,
                'close_form_time' => isset($request->close_form_time) ? "{$request->close_form_time}:00" : null,
                'start_time' => isset($request->start_time) ? "{$request->start_time}:00" : null,
                'end_time' => isset($request->end_time) ? "{$request->end_time}:00" : null,
            ]);

            $request->merge([
                'open_form_at' => trim($request->open_form_date . ' ' . $request->open_form_time) ?: null,
                'close_form_at' => trim($request->close_form_date . ' ' . $request->close_form_time) ?: null
            ]);

            $validator = Validator::make($request->all(), $this->generateValidationRules($request, $form));

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'validation_failed',
                    'error' => $validator->errors()->first()
                ]);
            }

            $availability = $form->availability ?? new FormAvailability();
            $availability->open_form_at = $request->open_form_at;
            $availability->close_form_at = $request->close_form_at;
            $availability->response_count_limit = $request->response_limit;
            $availability->available_weekday = $request->weekday;
            $availability->available_start_time = $request->start_time;
            $availability->available_end_time = $request->end_time;
            $availability->closed_form_message = $request->closed_form_message;
            $form->availability()->save($availability);

            return response()->json([
                'success' => true,
            ]);
        }
    }


}
