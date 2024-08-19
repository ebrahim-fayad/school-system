@extends('layouts.master')
@section('css')
@section('title')
    تعديل رسوم دراسية
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    تعديل رسوم دراسية
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

                    <form action="{{route('admin.Fees.update',$fee->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">الاسم باللغة العربية</label>
                                <input type="text" value="{{$fee->getTranslation('title','ar')}}" name="title_ar" class="form-control">
                                <input type="hidden" value="{{$fee->id}}" name="id" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">الاسم باللغة الانجليزية</label>
                                <input type="text" value="{{$fee->getTranslation('title','en')}}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">المبلغ</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">المرحلة الدراسية</label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $fee->Grade_id ? 'selected' : ""}}>{{ $Grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">الصف الدراسي</label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{$fee->Classroom_id}}">{{$fee->classroom->Name_Class}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">السنة الدراسية</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">نوع الرسوم</label>
                                <select class="custom-select mr-sm-2" name="Fee_type">
                                    <option value="1" {{ $fee->Fee_type == 1 ? 'selected' : '' }}>رسوم دراسية</option>
                                    <option value="2" {{ $fee->Fee_type == 2 ? 'selected' : '' }}>رسوم باص</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">ملاحظات</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4">{{$fee->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">تاكيد</button>

                    </form>

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
