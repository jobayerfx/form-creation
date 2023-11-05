<?php

namespace App\Http\Controllers\Form;

use App\Repositories\FormRepositoryInterface;
use Auth;
use App\Models\Form;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class FormController extends Controller
{
    public function __construct(FormRepositoryInterface $formRepository)
    {
        $this->formRepository = $formRepository;
    }

    public function index()
    {
        $current_user = Auth::user();
        $forms = $this->formRepository->getAllFormsForUser($current_user);
        return view('forms.form.index', compact('forms', 'current_user'));
    }

    public function create()
    {

        return view('forms.form.create');
    }

    public function store(Request $request)
    {
        $current_user = Auth::user();

        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'description' => 'required|string|min:10|max:30000'
        ]);

        $title = $request->input('title');
        $description = $request->input('description');

        $form = $this->formRepository->createForm($current_user, $title, $description);

        return redirect()->route('forms.show', $form->code);
    }

    public function show(Form $form)
    {
        $current_user = Auth::user();
        $not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
        abort_if($not_allowed, 404);

        $form->load('fields', 'collaborationUsers', 'availability');

        return view('forms.form.show', compact('form'));
    }

    public function edit(Form $form)
    {
        $current_user = Auth::user();
        $not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
        abort_if($not_allowed, 404);

        return view('forms.form.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $current_user = Auth::user();
        $not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
        abort_if($not_allowed, 404);

        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'description' => 'required|string|min:10|max:30000'
        ]);
        $title = $request->input('title');
        $description = $request->input('description');

        $form->title = ucfirst($title);
        $form->description = ucfirst($description);
        $form->save();

        return redirect()->route('forms.show', $form->code);
    }

    public function draftForm(Request $request, $form)
    {
        if ($request->ajax()) {
            $form = Form::where('code', $form)->with('fields')->first();

            if (!$form) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'validation_failed',
                    'error' =>  'Form is invalid',
                ]);
            }

            $current_user = Auth::user();
            $not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
            if ($not_allowed) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'not_allowed',
                    'error' =>  'Form is invalid'
                ]);
            }

            $inputs = [];
            $is_invalid_request = false;

            foreach ($request->except('_token') as $key => $value) {
                $key_parts = explode('_', $key);

                if (!is_array($key_parts) || count($key_parts) < 3) {
                    $is_invalid_request = true;
                    break;
                }

                $key_parts = array_reverse($key_parts);
                $field = array_shift($key_parts);
                $unique_key = array_shift($key_parts);
                $template = implode('_', array_reverse($key_parts));

                if (!in_array(str_replace('_', '-', $template), get_form_templates()->pluck('alias')->all())) {
                    $is_invalid_request = true;
                    break;
                }

                if ($template === 'linear_scale') {
                    $sub_key = substr($field, 0, 3);
                    if (in_array($sub_key, ['min', 'max'])) {
                        $field = "options.{$sub_key}." . substr($field, 3);
                    }
                }

                $new_key = "{$template}.{$unique_key}.{$field}";

                $inputs = Arr::add($inputs, $new_key, $value);
            }

            if ($is_invalid_request) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'validation_failed',
                    'error' =>  'Invalid request made. Please refresh the page'
                ]);
            }

            $validator = Validator::make($inputs, [
                'short_answer.*.question' => 'sometimes|required|string|min:3|max:255',
                'long_answer.*.question' => 'sometimes|required|string|min:3|max:60000',
                'multiple_choices.*.question' => 'sometimes|required|string|min:3|max:255',
                'multiple_choices.*.options.*' => 'required_with:multiple_choices.*.question|string|min:3|max:255',
                'checkboxes.*.question' => 'sometimes|required|string|min:3|max:255',
                'checkboxes.*.options.*' => 'required_with:checkboxes.*.question|string|min:3|max:255',
                'drop_down.*.question' => 'sometimes|required|string|min:3|max:255',
                'drop_down.*.options.*' => 'required_with:drop_down.*.question|string|min:3|max:255',
                'date.*.question' => 'sometimes|required|string|min:3|max:255',
                'time.*.question' => 'sometimes|required|string|min:3|max:255',
            ]);

            if ($validator->fails()) {
                $errors = collect($validator->errors())->flatten();
                return response()->json([
                    'success' => false,
                    'error_message' => 'validation_failed',
                    'error' =>  $errors->first()
                ]);
            }

            foreach ($form->fields as $field) {
                $field->question = ucfirst(data_get($inputs, "{$field->attribute}.question"));
                $field->required = data_get($inputs, "{$field->attribute}.required") ? true : false;
                $field->options = data_get($inputs, "{$field->attribute}.options");
                $field->filled = true;
                $field->save();
            }

            ($form->status === Form::STATUS_DRAFT) and $form->status = Form::STATUS_PENDING;
            $form->save();

            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function previewForm(Form $form)
    {
        $current_user = Auth::user();
        $not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
        abort_if($not_allowed, 404);

        return view('forms.form.view_form', ['form' => $form, 'view_type' => 'preview']);
    }

    public function openFormForResponse(Form $form)
    {
        $current_user = Auth::user();
        $not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
        abort_if($not_allowed, 403);

        $not_allowed = (!in_array($form->status, [Form::STATUS_PENDING, Form::STATUS_CLOSED]));
        abort_if($not_allowed, 403);

        $form->status = Form::STATUS_OPEN;
        $form->save();

        session()->flash('show', [
            'status' => 'success',
            'message' => 'Your form is now open to receive responses. You can now share it with other people.',
        ]);

        return redirect()->route('forms.show', $form->code);
    }

    public function closeFormToResponse(Form $form)
    {
        $current_user = Auth::user();
        $not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
        abort_if($not_allowed, 403);

        $not_allowed = ($form->status !== Form::STATUS_OPEN);
        abort_if($not_allowed, 403);

        $form->status = Form::STATUS_CLOSED;
        $form->save();

        session()->flash('show', [
            'status' => 'success',
            'message' => 'The form has been successfully closed. You can reopen it if you want to.',
        ]);

        return redirect()->route('forms.show', $form->code);
    }

    public function viewForm(Form $form)
    {
//        $not_allowed = !in_array($form->status, [Form::STATUS_OPEN, Form::STATUS_CLOSED]);
//        abort_if($not_allowed, 404);

        return view('forms.form.view_form', ['form' => $form, 'view_type' => 'form']);
    }


    public function destroy($form)
    {
        if (request()->ajax()) {
            $form = Form::where('code', $form)->first();

            if (!$form || $form->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'not_found',
                    'error' => 'Form is invalid'
                ]);
            }

            if ($form->status === Form::STATUS_OPEN) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'not_allowed',
                    'error' => 'Form cannot be deleted as it is still open. Close it first.'
                ]);
            }

            $form->delete();
            return response()->json([
                'success' => true,
            ]);
        }

        $form = Form::where('code', $form)->firstOrFail();

        $not_allowed = ($form->user_id !== Auth::id());
        abort_if($not_allowed, 404);

        $not_allowed = ($form->status === Form::STATUS_OPEN);
        abort_if($not_allowed, 403);

        $form->delete();

        session()->flash('index', [
            'status' => 'success',
            'message' => 'Form has been deleted'
        ]);

        return redirect()->route('forms.index');
    }
}
