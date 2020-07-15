@extends('layouts.backend.app')

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous"></script>

    <script>
        $('.dropify').dropify();

    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-settings bg-blue"></i>
            <div class="d-inline">
                <h5>@yield('h2','WebSite Settings')</h5>
                <span>@yield('span','Website Settings')</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <x-backend.breadcrumb></x-backend.breadcrumb>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="container card-body">
        <ul class="nav  nav-pills mb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Basic</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">ENV</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Integration</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form
                    action="{{ route('backend.settings.update',['action'=>'basic']) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="title">Website Name</label>
                                <input type="text"
                                    value="{{ setting('app.title','WebSite Title') }}"
                                    class="form-control" name="app.title" id="title" aria-describedby="title"
                                    placeholder="Website Title">
                                <small id="title" class="form-text text-muted">Website Name Title is here</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="description">Website Description</label>
                                <input type="text"
                                    value="{{ setting('app.description','WebSite Description') }}"
                                    class="form-control" name="app.description" id="description"
                                    aria-describedby="description" placeholder="Website description">
                                <small id="description" class="form-text text-muted">Website Description is here</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="email">Website Email</label>
                                <input type="email"
                                    value="{{ setting('app.email','admin@admin.com') }}"
                                    class="form-control" name="app.email" id="email" aria-describedby="email"
                                    placeholder="Website email">
                                <small id="email" class="form-text text-muted">Website email is here</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group"> Website Logo
                                <label class="custom-file">
                                    <input type="file" name="app.logo" data-max-file-size="500KB" data-min-height="300"
                                        data-min-width="500" id="app.logo" data-allowed-file-extensions="jpg jpeg png"
                                        placeholder="Logo" class="dropify" aria-describedby="logo"
                                        data-default-file="{{ Storage::url(Setting('app.logo','')) }}">
                                    <span class="custom-file-control"></span>
                                </label>
                                <small id="logo" class="form-text text-muted">Website Logo</small>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="app.tags">Website SEO Tags</label>
                                <textarea class="form-control" name="app.tags" id="app.tags"
                                    rows="3">{{ setting('app.tags') }}</textarea>
                            </div>
                        </div>


                    </div>
                    <button class="btn btn-success shadow" type="submit"><i class="ik ik-check-circle"></i>
                        Save</button>
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form
                    action="{{ route('backend.settings.update',['action'=>'env']) }}"
                    method="post">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="email_host">Website Email host</label>
                                <input type="text"
                                    value="{{ setting('email_host','127.0.0.1') }}"
                                    class="form-control" name="email_host" id="email_host" aria-describedby="email_host"
                                    placeholder="Website email_host">
                                <small id="email_host" class="form-text text-muted">Website email is here</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="email_port">Email Server Post</label>
                                <input type="text"
                                    value="{{ setting('email_port','587') }}"
                                    class="form-control" name="email_port" id="email_port" aria-describedby="email_port"
                                    placeholder="email Server port">
                                <small id="email_port" class="form-text text-muted">Website email Server Port is here</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="email_mailer">Mailer Mail</label>
                                <input type="text"
                                    value="{{ setting('email_mailer','admin@admin.com') }}"
                                    class="form-control" name="email_mailer" id="email_mailer" aria-describedby="email_mailer"
                                    placeholder="Website email_mailer">
                                <small id="email_mailer" class="form-text text-muted">Website Email Mailer is here</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="mail_username">Mail Server Username</label>
                                <input type="text"
                                    value="{{ setting('mail_username','admin@admin.com') }}"
                                    class="form-control" name="mail_username" id="mail_username" aria-describedby="mail_username"
                                    placeholder="Website mail_username">
                                <small id="mail_username" class="form-text text-muted">Website Email Username is here</small>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="mail_password">Mail Server Password</label>
                                <input type="password"
                                    value="***********"
                                    class="form-control" name="mail_password" id="mail_password" aria-describedby="mail_password"
                                    placeholder="">
                                <small id="mail_password" class="form-text text-muted">Website Email Password is here</small>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="mail_encryption">Mail Server Encryption</label>
                                <input type="text"
                                    value="{{ setting('mail_encryption','SSL') }}"
                                    class="form-control" name="mail_encryption" id="mail_encryption" aria-describedby="mail_encryption"
                                    placeholder="Website mail_encryption">
                                <small id="mail_encryption" class="form-text text-muted">Website Email Server Encryption</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="mail_from_name">Mail From Name</label>
                                <input type="text"
                                    value="{{ setting('mail_from_name','Admin') }}"
                                    class="form-control" name="mail_from_name" id="mail_from_name" aria-describedby="mail_from_name"
                                    placeholder="Website mail_from_name">
                                <small id="mail_from_name" class="form-text text-muted">Website Mail From Name</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="mail_from_address">Mail Frem</label>
                                <input type="text"
                                    value="{{ setting('mail_from_address','admin@admin.com') }}"
                                    class="form-control" name="mail_from_address" id="mail_from_address" aria-describedby="mail_from_address"
                                    placeholder="Website mail_from_address">
                                <small id="mail_from_address" class="form-text text-muted">Website Email SFrom</small>
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-success shadow" type="submit"><i class="ik ik-check-circle"></i>
                        Save</button>
                </form>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat cumque adipisci autem illo sit ratione
                error? Eum labore magnam, sapiente repellendus a ipsum blanditiis laboriosam eveniet sit sed molestias
                consectetur. 3
            </div>
        </div>
    </div>
</div>
@endsection
