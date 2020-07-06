<div>
    <div wire:loading class="w-100 h-100 py-5 text-center m-auto">
        <i class="ik ik-loader ik-5x"></i>
    </div>
    <div wire:loading.remove>
        <a href="javascript:void(0)" wire:click.prevent="selecteRoleselected" style="right: 5px;top: 5px" class="position-absolute text-danger">
            <i class="ik ik-2x ik-x-circle bg-white"></i>
        </a>

        @if ($selectedRole == 'select')
        <div class="row d-flex align-content-center justify-content-around align-items-center" >
            <div class="form-group col col-sm-12 col-md-11">
                <label for="role">Select Role</label>
                <select class="custom-select" name="role" id="role" wire:model="approle">
                    <option @if($approle == (null || 'null')) selected  @endif value="null">Select one</option>
                    @foreach ($roles as $role)
                    <option @if($approle == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-sm-12 col-md-1 mt-2">
                <a href="javascript:void(0)" wire:click.prevent="selecteRolesEmpty" class="btn btn-success btn-icon"><i class="ik ik-plus"></i></a>
            </div>
        </div>

        @elseif($selectedRole)

        @else
        <form wire:submit.prevent="save" action="#" method="post">

            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="name" placeholder="Role Name" wire:model.lazy="name">
                    <small id="name" class="form-text text-muted @error('name') d-none @enderror">
                        Role Name For user group
                    </small>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea wire:model.lazy="description" class="form-control @error('description') is-invalid @enderror"
                    name="description" id="description" rows="3"></textarea>
            </div>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <br>
            @csrf

            <button type="submit" @if(!$name) disabled  @endif wire:click="save" name="save" id="save" class="btn btn-primary" btn-lg
                btn-block">Save</button>
        </form>
        @endif


    </div>
</div>

