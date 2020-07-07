<form action="" class="row" wire:submit.prevent="update">
    <div class="col-sm-12 col-md-8">
        <div class="card">
            <div class="form-horizontal card-body">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" wire:model.lazy="name" placeholder="Johnathan Doe"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" placeholder="ahmadeyamin@gmial.com"
                        class="form-control @error('email') is-invalid @enderror" wire:model.lazy="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        wire:model.lazy="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone No</label>
                    <input type="text" placeholder="123 456 7890" wire:model.lazy="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message">Bio</label>
                    <textarea name="message" wire:model.lazy="bio" rows="5" class="form-control"></textarea>
                </div>

                <button class="btn btn-success shadow" type="submit"><i class="ik ik-check-circle"></i> Update</button>

                <button type="button" onclick="return confirm('Are You Sure. It Will Make User Role Empty') ? @this.call('delete') : false;
                " name="delete" id="delete" class="btn float-right shadow btn-danger btn-lg"> <i class="ik ik-trash"></i> Delete</button>

            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center">


                    <label for="avatar" class="user_avatar">
                        <div class="user_avatar_overlay"></div>
                        @if ($avatarNew)
                        <img src="{{$avatarNew->temporaryUrl()}}" class="rounded-circle shadow">
                        @else
                        <img src="{{$avatar}}" class="rounded-circle shadow">
                        @endif
                    </label>
                    <br>
                    <p wire:loading wire:target="avatarNew" class="text-success text-small">
                        Uploading
                    </p>
                    @error('avatar')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    <input id="avatar" class="d-none" type="file" wire:model="avatarNew">

                    <h4 class="card-title mt-10"> {{$name??'Jone Smith'}}</h4>

                </div>
                <div class="form-check pl-0">
                    <label class="">
                        <input type="checkbox" @if($status) checked=""  @endif class="js-small" id="checkbox" wire:model.lazy="status" >
                        <span class="">&nbsp; Active Status</span>
                    </label>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <hr>
                <div class="">
                    <div class="form-group">
                        <label for="country">Select Role</label>
                        <select wire:model.lazy="role" class="form-control @error('role') is-invalid @enderror">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" @if($user->role_id == $role->id) selected="" @endif >
                                {{$role->name}}
                            </option>
                            @endforeach
                        </select>

                        @error('role')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" wire:model.lazy="username">
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
