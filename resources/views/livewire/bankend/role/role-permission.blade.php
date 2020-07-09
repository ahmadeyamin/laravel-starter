<div>
    @if ($modules)
        <label class="form-check-label d-flex align-content-center align-items-center">
            <input type="checkbox" wire:model="checkall" class="checkbox">
            <span class="ml-2">All</span>
        </label>
    @endif

    <div wire:loading class="w-100 h-100 py-5 text-center m-auto">
        <i class="ik ik-loader ik-5x"></i>
    </div>
    <br>

    <form wire:submit.prevent="save" method="post" >
        <div class="row" wire:loading.remove >

            @forelse ($modules as $key => $module)

            <div class="col-sm-12 col-md-6">

                <h2>{{$module->name}}</h2>

                @forelse ($module->permissions as $permission)
                   <div class="form-check my-2 ">
                     <label class="form-check-label d-flex align-content-center align-items-center">
                        <input
                        type="checkbox"
                        class="form-check-input checkbox"
                        value="{{$permission->id}}"
                        id="{{ rand() }}"
                        wire:model="apppermission.{{$permission->id}}"
                        />

                        <span class="d-inline-block pl-2" style="cursor: pointer">{{$permission->name}}</span>
                     </label>
                   </div>
                @empty
                   <h2 class="text-danger text-center d-block font-weight-bold w-100">Permission Not Found</h2>
                @endforelse
            </div>
            <hr>
            @empty
                   <h2 class="text-danger text-center d-block font-weight-bold w-100">No Role Selected</h2>
            @endforelse

            @error('apppermission')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <button  type="submit" class="shadow mt-5 btn btn-primary @if(!$modules) d-none @endif mx-3" ><i class="ik ik-check-circle"></i>Save </button>
        </div>

    </form>
</div>
