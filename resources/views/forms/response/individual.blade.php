@php

    $response = ($responses) ? $responses->first() : null;
    $response_data = ($responses) ? $response->getQuestionAnswerMap() : null;
@endphp

<div class="card">
    <div class="card-header">
        <h6 class="card-title">Submitted: <small>{{ $response->created_at->format('jS F, Y g:i a') }} ({{ $response->created_at->diffForHumans() }})</small></h6>
        <div class="d-flex justify-content-between">
            {{ $responses->appends(['type' => 'individual'])->onEachSide(2)->links('vendor.pagination.panel-header', ['pagination_class' => 'pagination-flat pagination-sm position-left']) }}

            @if (!empty($response_data))
                <a href="javascript:void(0)" id="delete-button" data-href="{{ route('forms.responses.destroy.single', [$form->code, $response->id]) }}" data-item="form response" class="btn btn-danger btn-sm">Delete Response</a>
            @endif
        </div>
    </div>

    <div class="card-body">
        @foreach ($response_data as $data)
            <div class="row">
                <div class="col-md-12">
                    <label class="label-xl">{{ $data['question'] }}
                        @if ($data['required']) <span class="text-danger">*</span> @endif
                    </label>
                    @php
                        $value = '';
                        if ($data['answer']) {
                            $value = $data['answer'];
                        } else {
                            $value = 'NIL';
                        }
                    @endphp
                    <div class="form-control-static form-underline pb-3">{!! $value !!}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
