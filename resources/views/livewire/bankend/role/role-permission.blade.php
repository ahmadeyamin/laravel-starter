<div>
    <div wire:loading class="w-100 h-100 py-5 text-center m-auto">
        <i class="ik ik-loader ik-5x"></i>
    </div>
    <br>
    {{-- <label>
        <input  type="checkbox" class="checkbox">
        <span>Select All</span>
    </label> --}}
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
                        {{-- @if($permission->hasRole($roleId)) checked @endif --}}
                        {{-- name="apppermission[]" --}}
                        value="{{$permission->id}}"
                        {{-- wire:change="$set('apppermission.{{$permission->id}}',false)" --}}
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

            <button  type="submit" class="btn btn-primary @if(!$modules) d-none @endif mx-3" >Save</button>
        </div>

    </form>
</div>



<script defer>
    // window.addEventListener('load',e=>{
    //     document.getElementById('dfudyf').addEventListener('submit',e=>{
    //         e.preventDefault();
    //         console.log(checkedarray);

    //     })
    //     console.log('ok');
    // })

    // function submit_all() {
    //     console.log(checkedarray);
    //     @this.set('permissions', checkedarray);
    //     document.getElementById('dfudyf').submit();
    // }
</script>
