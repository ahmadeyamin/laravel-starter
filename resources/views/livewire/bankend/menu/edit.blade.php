<div>
    <div class="modal-header">
        <h5 class="modal-title text-center">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="#" method="post" wire:submit.prevent="save">
        <div wire:loading class="w-100 h-100 py-5 text-center m-auto">
            <i class="ik ik-loader ik-5x"></i>
        </div>
        <div class="modal-body"  wire:loading.remove>
            <div class="form-group">
                <label for="name">Menu Name <span class="text-danger">*</span></label>
                <input wire:model.lazy="name" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror " placeholder="Menu Name" aria-describedby="name">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <small id="namehelp" class="text-muted">Menu Name</small>
                @enderror
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea wire:model.lazy="description" class="form-control shadow-sm" name="description" id="description" rows="3"></textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @else
                    <small id="description" class="text-muted">Description About This menu</small>
                @enderror
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" onclick="return confirm('Are You Sure. It Will Delete Menu all items') ? @this.call('delete') : false;" name="delete" id="delete" class="btn float-right shadow btn-danger btn-lg"> <i class="ik ik-trash"></i> Delete</button>

            <button type="submit" class="btn btn-primary shadow">Save</button>
        </div>
    </form>
</div>
