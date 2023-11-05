<div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
        Options
    </button>
    <ul class="dropdown-menu">
        <li class="dropdown-header highlight"><i class="icon-menu7"></i> <i class="icon-share3 pull-right"></i> Share</li>

            <li><a class="dropdown-item" href="{{ route('forms.view', $form->code) }}" target="_blank">View Form/Share</a></li>

            <li class="dropdown-header highlight"><i class="icon-menu7"></i> <i class="icon-menu6 pull-right"></i> Responses</li>
            @if (Route::currentRouteName() !== 'forms.responses.index')
                <li><a class="dropdown-item" href="{{ route('forms.responses.index', $form->code) }}">View Responses</a></li>
            @endif


        <li class="dropdown-header highlight"><i class="icon-menu7"></i> <i class="icon-gear pull-right"></i> Form Menu</li>
        @if (Route::currentRouteName() !== 'forms.show')
            <li><a class="dropdown-item" href="{{ route('forms.show', $form->code) }}">View Form Template</a></li>
        @endif


        <li><a class="dropdown-item" href="{{ route('forms.edit', $form->code) }}">Edit Form</a></li>
        @if ($form->status !== $form::STATUS_OPEN)
            <li><a class="dropdown-item" id="delete-button" data-href="{{ route('forms.destroy', $form->code) }}" data-item="form - {{ $form->title }}">Delete Form</a></li>
        @endif
        <li><a class="dropdown-item" href="{{ route('forms.index') }}">All Forms</a></li>
    </ul>
</div>
