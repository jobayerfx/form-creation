@if (session()->has($name) || !empty($forced_alert))
	@php
		$alert = (session()->has($name)) ? session($name) : $forced_alert;
	@endphp
	<div id="flash" class="alert alert-{{ $alert['status'] }} alert-dismissible fade show" role="alert">
        {{ $alert['message'] }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@endif
