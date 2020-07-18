<script type="text/javascript">

@if(session()->has('success'))
$.toast({
    heading: 'Success',
    text: '{{ ucfirst(session('success')) }}',
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
        text: '{{ ucfirst($error) }}',
        showHideTransition: 'fade',
        icon: 'error',
        loaderBg: '#00ffdd',
        position: 'bottom-left'
    })
@endforeach
@endif


</script>
