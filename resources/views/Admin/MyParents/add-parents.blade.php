@extends('layouts.master')
@section('title')
    {{ trans('main_trans.Add_Parent') }}
@endsection
@section('css')
    <style>
        .box-container {
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 1rem;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .box-container .box {
            background: #423838;
            display: block;
            width: 110px;
            height: 110px;
            position: relative;
            overflow: hidden;
        }

        .box-container .box img {
            width: 100%;
            height: auto;
        }

        .box-container .box a {
            position: absolute;
            right: 7px;
            bottom: 5px;
        }

        .swal2-popup {
            font-size: .87em;
        }
    </style>
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
                @livewire('admin.parents.add-parent')
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
