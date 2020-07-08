<div>
    <div class="modal-header">
        <h5 class="modal-title text-center">Create Module</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="#" method="post" wire:submit.prevent="save">

        <div class="modal-body">

            <div class="form-group d-block">
                <label for="module">Select Module  <span class="text-danger">*</span></label>
                <select class="form-control select2 @error('module') is-invalid @enderror"
                    name="module" id="module">
                    <option>--Select Module--</option>
                    @foreach($modules as $imodule)
                        <option value="{{ $imodule->id }}" @if($imodule->id == $module) selected @endif>{{ $imodule->name }}</option>
                    @endforeach
                </select>
                @error('module')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <small id="mname_help" class="text-muted">Select Permission Group</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Permission Name <span class="text-danger">*</span></label>
                <input wire:model.lazy="name" type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror " placeholder="Access Setting"
                    aria-describedby="pname_help">

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <small id="pname_help" class="text-muted">Name Of Permissions</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="slug">Permission Slug <span class="text-danger">*</span></label>
                <input wire:model.lazy="slug" type="text" name="slug" id="slug"
                    class="form-control @error('slug') is-invalid @enderror" placeholder="app.setting.index"
                    aria-describedby="pslug_help">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <small id="pslug_help" class="text-muted">Permission Slug for searchin database</small>
                @enderror
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close <i class="ik ik-times"></i></button>
            <button type="submit" class="btn btn-primary shadow">Save changes <i class="ik ik-check-circle"></i></button>
        </div>
    </form>
</div>
