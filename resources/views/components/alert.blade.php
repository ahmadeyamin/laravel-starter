<script type="text/javascript">

@if(session()->has('success'))
$.toast({
    heading: 'Success',
    text: '{{ session('success') }}',
    showHideTransition: 'fade',
    icon: 'success',
    loaderBg: '#00ffdd',
    position: 'bottom-left'
})
@endif


@if ($errors->any())

@foreach ($errors->all() as $error)
    $.toast({
        heading: 'Error',
        text: '{{ $error }}',
        showHideTransition: 'fade',
        icon: 'Error',
        loaderBg: '#00ffdd',
        position: 'bottom-left'
    })
@endforeach
@endif


</script>
