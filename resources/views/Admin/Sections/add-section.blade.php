<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{ trans('Sections_trans.add_section') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.sections.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <input type="text" name="Name_Section_Ar" class="form-control"
                                placeholder="{{ trans('Sections_trans.Section_name_ar') }}">
                        </div>
                        <div class="col">
                            <input type="text" name="Name_Section_En" class="form-control"
                                placeholder="{{ trans('Sections_trans.Section_name_en') }}">
                        </div>

                    </div>
                    <br>
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                        <select name="Grade_id" class="custom-select">
                            <!--placeholder-->
                            <option value="" selected disabled>
                                {{ trans('Sections_trans.Select_Grade') }}
                            </option>
                            @foreach ($Grades as $Grade)
                                <option value="{{ $Grade->id }}"> {{ $Grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                        <select name="Class_id" class="custom-select">
                        </select>
                    </div>
                    <br>
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('Teacher_trans.Name_Teacher') }}</label>
                        <select name="teachers[]" multiple class="custom-select">
                            <!--placeholder-->
                            <option value="" selected disabled>
                                {{ trans('Teacher_trans.select-teacher') }}
                            </option>
                            @foreach ($Teachers as $Teacher)
                                <option value="{{ $Teacher->id }}"> {{ $Teacher->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
