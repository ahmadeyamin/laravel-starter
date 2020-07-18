@extends('layouts.backend.app')

@section('title','Create New Page')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-package bg-green"></i>
            <div class="d-inline">
                <h5>@yield('h2','Add New Pages')</h5>
                <span>@yield('span','')</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <x-backend.breadcrumb></x-backend.breadcrumb>
    </div>
</div>
@endsection



@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush



@section('content')
<div class="card">
    <div class="card-header justify-content-between">
        <h3>Add New Page</h3>
        <a class="btn btn-theme shadow" href="{{ URL::previous() }}">Back</a>
    </div>
    <div class="card-body">
        <div>
            <form action="{{ route('backend.pages.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">Page Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Page Title"
                                aria-describedby="page_title">
                            <small id="page_title" class="text-muted">Page Title</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="slug">Page Title Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Page Title"
                                aria-describedby="page_slug">
                            <small id="page_slug" class="text-muted">Page Title Slug</small>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="status">Active Status<span class="text-danger">*</span></label>
                            <input type="checkbox" name="status" id="status" class="form-control switchery" checked />
                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <textarea id="kt-tinymce" style="height:500px" name="content"
                            class="tox-target w-100"></textarea>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group"> Website Logo
                            <label class="custom-file">
                                <input type="file" name="thumbnail" data-max-file-size="1MB"  id="thumbnail" data-allowed-file-extensions="jpg jpeg png"
                                    placeholder="thumbnail" class="dropify" aria-describedby="thumbnail"
                                    >
                                <span class="custom-file-control"></span>
                            </label>
                            <small id="thumbnail" class="form-text text-muted">Page thumbnail</small>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-primary shadow mt-5 btn-lg btn-block"><i class="ik ik-check-circle"></i> Save</button>
            </form>
        </div>

    </div>
</div>


@endsection


@push('js')
    <script sync src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script sync src="https://cdn.tiny.cloud/1/xcbqo0ub2ufoqnd744337p9sxahsz8myictfnjhi8ikk9ib9/tinymce/5.2.2-80/tinymce.min.js"></script>

    <script sync src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>

    <script>
        $('.dropify').dropify();
        tinymce.init({
            selector: "#kt-tinymce",
            toolbar: [
                "styleselect fontselect fontsizeselect undo redo | cut copy | bold italic | link image | alignleft aligncenter alignright alignjustify bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            plugins: "advlist autolink link image lists charmap print preview code"
        })

        var html = document.querySelector('.switchery')
        new Switchery(html, {
            color: '#4099ff',
            jackColor: '#fff',
            size: 'small'
        });
    </script>
@endpush
