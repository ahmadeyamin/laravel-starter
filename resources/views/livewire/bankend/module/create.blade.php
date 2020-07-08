<div>
    <div class="modal-header">
        <h5 class="modal-title text-center">Create New Module</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="#" method="post" wire:submit.prevent="save">

        <div class="modal-body">


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
            <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary shadow">Save</button>
        </div>
    </form>
</div>
