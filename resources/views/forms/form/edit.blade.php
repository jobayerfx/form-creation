@section('title', "My Forms | Edit Form")

@extends('layouts.app')

@section('content')
    <div class="text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">My Forms</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('forms.index') }}" class="btn btn-circle btn-secondary ">
                    <span>Forms List</span>
                </a>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="row">
            <div class="card-header">
                <h5 class="card-title">Edit Form  - {{ $form->title }}</h5>
            </div>
            <div class="card-body">
                @include('forms.form._form', ['type' => 'edit'])
            </div>
        </div>
    </div>
@endsection
