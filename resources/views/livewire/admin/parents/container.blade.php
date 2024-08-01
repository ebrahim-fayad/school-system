<div>

    @include('livewire.admin.parents.Father_Form')
    @include('livewire.admin.parents.Mother_Form')

    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        @if ($currentStep != 3)
            <div style="display: none" class="row setup-content" id="step-3">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من حفظ البيانات ؟</h3><br>
                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right " style="margin-left: 5px" type="button"
                    wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>
                <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                    type="button">{{ trans('Parent_trans.Finish') }}</button>
            </div>
            <div class="col-md-12 " style="margin-top: 40px;">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" accept="image/*" wire:model='photos' multiple>
                </form>
            </div>
            <div>

                @foreach ($photos as $photo)
                  <img src="{{ $photo->temporaryUrl() }}" width="100" height="100"  alt="">
                @endforeach

            </div>
        </div>
    </div>
</div>
