@extends('layouts.master')
@section('content')
<livewire:live-email>

@endsection

@section('js')



<script>
        
    window.addEventListener('swal',function(e){
            
            Swal.fire({
                title: e.detail[0]['title'],
                text: e.detail[0]['text'],
                icon: e.detail[0]['icon'],
                timer: e.detail[0]['timer'],
               
            });
          
            $('#smallModal').modal('hide');
        });
       
</script>