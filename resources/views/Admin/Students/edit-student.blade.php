@extends('layouts.master')
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
@section('title')
    {{ trans('Students_trans.Student_Edit') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.Student_Edit') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
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

                <form action="{{ route('admin.students.update', $Student->id) }}" method="post"
                    enctype="multipart/form-data" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('Students_trans.personal_information') }}</h6><br>
                    <div class="pd-30 pd-sm-40 bg-gray-200">
                        <div>
                            @if ($Student->profilePhoto)
                                <img style="border-radius:20%" src="{{asset('attachments/'.$Student->profilePhoto )}}"height="150px"
                                    width="150px" alt="">
                            @else
                                <img style="border-radius:20%" src="{{ asset('assets/images/student.png') }}"
                                    height="100" width="100" alt="">
                            @endif

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.name_ar') }} : <span
                                        class="text-danger">*</span></label>
                                <input value="{{ $Student->getTranslation('name', 'ar') }}" type="text"
                                    name="name_ar" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.name_en') }} : <span
                                        class="text-danger">*</span></label>
                                <input value="{{ $Student->getTranslation('name', 'en') }}" class="form-control"
                                    name="name_en" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.email') }} : </label>
                                <input type="email" value="{{ $Student->email }}" name="email"
                                    class="form-control">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.password') }} :</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">{{ trans('Students_trans.gender') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="gender_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($Genders as $Gender)
                                        <option value="{{ $Gender->id }}"
                                            {{ $Gender->id == $Student->gender_id ? 'selected' : '' }}>
                                            {{ $Gender->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nal_id">{{ trans('Students_trans.Nationality') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="nationality id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($nationals as $nal)
                                        <option value="{{ $nal->id }}"
                                            {{ $nal->id == $Student->nationality_id ? 'selected' : '' }}>
                                            {{ $nal->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bg_id">{{ trans('Students_trans.blood_type') }} : </label>
                                <select class="custom-select mr-sm-2" name="blood_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($bloods as $bg)
                                        <option value="{{ $bg->id }}"
                                            {{ $bg->id == $Student->blood_id ? 'selected' : '' }}>{{ $bg->Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ trans('Students_trans.Date_of_Birth') }} :</label>
                                <input class="form-control" type="text" value="{{ $Student->Date_Birth }}"
                                    id="datepicker-action" name="Date_Birth" data-date-format="yyyy-mm-dd">
                            </div>
                        </div>

                    </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{ trans('Students_trans.Student_information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($Grades as $Grade)
                                        <option value="{{ $Grade->id }}"
                                            {{ $Grade->id == $Student->Grade_id ? 'selected' : '' }}>
                                            {{ $Grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{ $Student->Classroom_id }}">
                                        {{ $Student->classroom->Name_Class }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                <select class="custom-select mr-sm-2" name="section_id">
                                    <option value="{{ $Student->section_id }}">
                                        {{ $Student->section->Name_Section }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="parent_id">{{ trans('Students_trans.parent') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="parent_id">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}"
                                            {{ $parent->id == $Student->parent_id ? 'selected' : '' }}>
                                            {{ $parent->Name_Father }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @php
                                        $current_year = date('Y');
                                    @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year }}"
                                            {{ $year == $Student->academic_year ? 'selected' : ' ' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-1">
                            <label for="exampleInputEmail1">
                                {{ trans('Students_trans.student_image') }}</label>
                        </div>
                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                            <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                            <img style="border-radius:50%" width="150px" height="150px" id="output" />
                        </div>
                        @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('Students_trans.submit') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box min-height-200px pd-20 mb-20">
            <div class="title mb-2">
                <h6>Additional Student Attachments</h6>
            </div>
            <form action="{{ route('admin.upload-images', $Student->id) }}" method="POST" class="dropzone">
                @csrf
            </form>
            <button class="btn btn-outline-primary btn-sm mt-2" type="submit"
                id="uploadAdditionalImagesBtn">Upload</button>
        </div>
    </div>
    <div class="box-container mb-2" id="product_images" data-image="{{ $Student->id }}">
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                var url = "{{ route('admin.getClasses', ['id' => '0']) }}";
                url = url.replace('/0', '/' + Grade_id);
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $('select[name="Classroom_id"]').empty();
                        $('select[name="Classroom_id"]').append(
                            '<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>'
                        );
                        $.each(data, function(key, value) {
                            $('select[name="Classroom_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error:', error);
                    }
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('select[name="Classroom_id"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                var url = "{{ route('admin.getSections', ['id' => '0']) }}";
                url = url.replace('/0', '/' + Classroom_id);
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append(
                            '<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>'
                        );
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
<script>
    //    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone('.dropzone', {
        autoProcessQueue: false,
        parallelUploads: 1, //Number of files proccessed at a time
        addRemoveLinks: true,
        maxFilesize: 2, // 2MB
        acceptedFiles: 'image/*',
        init: function() {
            thisDz = this;
            var uploadBtn = document.getElementById('uploadAdditionalImagesBtn');
            uploadBtn.addEventListener('click', function() {
                var nFiles = myDropzone.getQueuedFiles().length;
                thisDz.options.parallelUploads = nFiles;
                thisDz.processQueue();
            });

            thisDz.on('queuecomplete', function() {
                this.removeAllFiles();
                getProductImages();
            });
        }
    });
    getProductImages();

    function getProductImages() {

        var element = document.getElementById('product_images');
        var id = element.getAttribute('data-image');
        if (id) {
            var url = "{{ route('admin.get-product-images', ['id' => '0']) }}";
            url = url.replace('/0', '/' + id);
        }
        $.get(url, {}, function(response) {
            $('div#product_images').html(response.data);
        }, 'json');

    }
    $(document).on('click', '#deleteStudentAttachment', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-image');
        if (id) {
            var url = "{{ route('admin.delete-student-image', ['id' => '0']) }}";
            url = url.replace('/0', '/' + id);
        }
        var _token = '{{ csrf_token() }}';
        $.ajax({
            url: url,
            type: 'post',
            data: {
                _token: _token
            },
            success: function(data) {
                getProductImages();

            }
        });
    });
</script>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endsection
