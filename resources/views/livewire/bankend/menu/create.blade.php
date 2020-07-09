<div>
    <div class="modal-header">
        <h5 class="modal-title text-center">Create New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="#" method="post" wire:submit.prevent="save">

        <div class="modal-body">
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
            <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary shadow">Save</button>
        </div>
    </form>
</div>
