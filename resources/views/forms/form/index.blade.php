@section('title', 'My Forms')

@extends('layouts.app')

@section('content')
    <div class="text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">My Forms</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('forms.create') }}" class="btn btn-circle btn-secondary">
                    <span>Add New Form</span>
                </a>
            </div>
        </div>
    </div>
    <br>

    @include('partials.alert', ['name' => 'index'])

    <div class="container">
        <div class="row">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Form Title</th>
                        <th class="text-center">Date Created</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $symbols = App\Models\Form::getStatusSymbols() @endphp
                    @foreach ($forms as $form)
                        @php
                            $symbol = $symbols[$form->status];
                            $role_symbol = ($form->user_id === $current_user->id) ? ['role' => 'Owner', 'color' => 'success'] : ['role' => 'Collaborator', 'color' => 'primary'];
                        @endphp
                        <tr>
                            <td></td>
                            <td>{{ $form->title }}</td>
                            <td class="text-center">{{ $form->created_at->format('jS F, Y') }}</td>
                            <td class="text-center"><span class="label label-flat border-{{ $role_symbol['color'] }} text-{{ $role_symbol['color'] }}-600">{{ $role_symbol['role'] }}</span></td>
                            <td class="text-center"><span class="label bg-{{ $symbol['color'] }}">{{ $symbol['label'] }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('forms.show', $form->code) }}" class="btn btn-xs btn-primary mb-5"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('forms.edit', $form->code) }}" class="btn btn-xs btn-info mb-5 position-right"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('forms.destroy', $form->code) }}" class="btn btn-xs btn-danger mb-5 position-right" data-id="{{ $form->code }}" data-method="delete" data-item="form" data-ajax="true"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable(
                {
                    "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
                    "iDisplayLength": 5
                }
            );
        } );

        function checkAll(bx) {
            var cbs = document.getElementsByTagName('input');
            for(var i=0; i < cbs.length; i++) {
                if(cbs[i].type == 'checkbox') {
                    cbs[i].checked = bx.checked;
                }
            }
    </script>
@endsection
