@extends('layouts.master')
@section('css')
@section('title')
{{ trans('main_trans.List_Teachers') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('main_trans.List_Teachers') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{ route('admin.teachers.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ trans('Teacher_trans.Add_Teacher') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Teacher_trans.teacher_image') }}</th>
                                            <th>{{ trans('Teacher_trans.Name_Teacher') }}</th>
                                            <th>{{ trans('Teacher_trans.Gender') }}</th>
                                            <th>{{ trans('Teacher_trans.Joining_Date') }}</th>
                                            <th>{{ trans('Teacher_trans.specialization') }}</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Teachers as $Teacher)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            @if ($Teacher->image)
                                            <td><img src="{{ asset('attachments/'.$Teacher->image->fileName) }}"   height="50px" width="50px"alt=""></td>
                                            @else
                                            <td><img  src="{{ asset('attachments/Teachers/teacher.png') }}"   height="50px" width="50px"alt=""></td>
                                            @endif
                                            <td>{{ $Teacher->Name }}</td>
                                            <td>{{ $Teacher->Gender->Name }}</td>
                                            <td>{{ $Teacher->Joining_Date }}</td>
                                            <td>{{ $Teacher->Specialization->Name }}</td>
                                            <td>
                                                <a href="{{ route('admin.teachers.edit', $Teacher->id) }}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_Teacher{{ $Teacher->id }}"
                                                    title="{{ trans('Grades_trans.Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- delte modal -->
                                        @include('Admin.Teachers.delete-teacher')
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@endsection
