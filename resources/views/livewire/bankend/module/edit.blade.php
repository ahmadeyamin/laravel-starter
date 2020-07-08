<div>
    <div class="modal-header">
        <h5 class="modal-title text-center">Create New Module</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="#" method="post" wire:submit.prevent="update">
        <div wire:loading class="w-100 h-100 py-5 text-center m-auto">
            <i class="ik ik-loader ik-5x"></i>
        </div>
        <div class="modal-body" wire:loading.remove>


            <div class="form-group">
                <label for="name">Module Name <span class="text-danger">*</span></label>
                <input wire:model.lazy="name" type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror " placeholder="Module Name"
                    aria-describedby="name">

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <small id="name" class="text-muted">Module is like group or section of permission  </small>
                @enderror
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button"  class="btn btn-danger shadow"  onclick="return confirm('Are You Sure. It Will Make User Role Empty') ? @this.call('delete') : false;
            ">Delete <i class="ik ik-trash"></i></button>
            <button type="submit" class="btn btn-primary shadow"><i class="ik ik-check-circle"></i> Save</button>
        </div>
    </form>
</div>
