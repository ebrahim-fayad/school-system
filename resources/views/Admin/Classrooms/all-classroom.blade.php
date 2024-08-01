@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('My_Classes_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('My_Classes_trans.add_class') }}
                </button>
                <button type="button" class="button x-small" id="btn_delete_all">
                    {{ trans('My_Classes_trans.delete_checkbox') }}
                </button>
                <br><br>
                <form action="{{ route('admin.classrooms.FilterClass') }}" class="form mb-3" method="POST">
                    {{ csrf_field() }}
                    <select class="selectpicker bg-success text-white p-3" data-style="btn-info" name="Grade_id" required
                            onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('My_Classes_trans.Search_By_Grade') }}</option>
                        @foreach ($Grades as $Grade)
                            <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                        @endforeach
                    </select>
                </form>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id='select_all'></th>
                                <th>#</th>
                                <th>{{ trans('My_Classes_trans.Name_class') }}</th>
                                <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>
                                <th>{{ trans('My_Classes_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($My_Classes as $My_Class)
                                <tr>

                                    <td><input type="checkbox" class="box1" value="{{ $My_Class->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $My_Class->Name_Class }}</td>
                                    <td>{{ $My_Class->Grade->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $My_Class->id }}"
                                            title="{{ trans('Grades_trans.Edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $My_Class->id }}"
                                            title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <!-- edit_modal_Grade -->
                                @include('Admin.Classrooms.edite')
                                <!-- delete_modal_Grade -->
                                @include('Admin.Classrooms.delete')
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- add_modal_class -->
    @include('Admin.Classrooms.add-calssroom')
    <!-- delte selected rows -->
    @include('Admin.Classrooms.delete-selected')

</div>

<!-- row closed -->
@endsection
@section('js')
<script>
    document.getElementById('select_all').addEventListener('change', function() {
        var isChecked = this.checked;
        var checkboxes = document.querySelectorAll('.box1');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
    });
    document.getElementById('btn_delete_all').addEventListener('click', function() {
    var selectedValues = [];
    var checkboxes = document.querySelectorAll('.box1:checked');
    checkboxes.forEach(function(checkbox) {
        selectedValues.push(checkbox.value);
    });

    // Set values to hidden input
    if (selectedValues.length > 0) {
        // Set values to hidden input
        document.getElementById('delete_all_id').value = selectedValues.join(',');

        // Open modal
        $('#delete_all').modal('show');
    } else {
        // Alert user if no checkbox is selected
        alert('يجب تحديد عنصر واحد على الأقل قبل متابعة الحذف.');
    }
});
</script>

@endsection
