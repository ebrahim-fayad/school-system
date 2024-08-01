@extends('layouts.master')
@section('title')
    {{ trans('main_trans.Add_Parent') }}
@endsection
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Add_Parent') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a href="{{ route('admin.MyParents') }}" class="btn btn-success btn-sm btn-lg pull-right" >{{ trans('Parent_trans.add_parent') }}</a><br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-success">
                                <th>#</th>
                                <th>{{ trans('Parent_trans.Email') }}</th>
                                <th>{{ trans('Parent_trans.Name_Father') }}</th>
                                <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                                <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
                                <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                                <th>{{ trans('Parent_trans.Job_Father') }}</th>
                                <th>{{ trans('Parent_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($my_parents as $my_parent)
                                <tr>
                                    <td>{{ $my_parent->iteration }}</td>
                                    <td>{{ $my_parent->Email }}</td>
                                    <td>{{ $my_parent->Name_Father }}</td>
                                    <td>{{ $my_parent->National_ID_Father }}</td>
                                    <td>{{ $my_parent->Passport_ID_Father }}</td>
                                    <td>{{ $my_parent->Phone_Father }}</td>
                                    <td>{{ $my_parent->Job_Father }}</td>
                                    <td>
                                        <button wire:click="edit({{ $my_parent->id }})"
                                            title="{{ trans('Grades_trans.Edit') }}" class="btn btn-primary btn-sm"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            wire:click="delete({{ $my_parent->id }})"
                                            title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
