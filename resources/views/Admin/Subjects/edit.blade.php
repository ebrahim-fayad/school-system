@extends('layouts.master')
@section('css')
@section('title')
    اضافة مادة دراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة مادة دراسية
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
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('admin.subjects.update',$subject->id) }}" method="post" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">اسم المادة باللغة العربية</label>
                                    <input type="text" name="Name_ar" class="form-control" value="{{ $subject->getTranslation('name','ar') }}">
                                </div>
                                <div class="col">
                                    <label for="title">اسم المادة باللغة الانجليزية</label>
                                    <input type="text" name="Name_en" class="form-control" value="{{ $subject->getTranslation('name','en') }}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputState">المرحلة الدراسية</label>
                                    <select class="custom-select mr-sm-2" name="Grade_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($grades as $g)
                                            <option value="{{ $g->id }}" {{ $subject->grade_id == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col">
                                    <label for="inputState">الصف الدراسي</label>
                                    <select class="custom-select mr-sm-2" name="Classroom_id">
                                        <option value="{{ $subject->classroom->id }}">{{ $subject->classroom->Name_Class }}</option>
                                    </select>
                                </div>


                                <div class="form-group col">
                                    <label for="inputState">اسم المعلم</label>
                                    <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ $subject->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ
                                البيانات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

@endsection
