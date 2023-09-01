@extends('layouts.master')
@section('content')
<livewire:live-porfolio>

<style>
  .imgspace {
    max-width: 400px;
    max-height: 400px;
    width: auto;
    height: auto;
}
.imgcel {
    max-width: 100px;
    max-height: 100px;
    width: auto;
    height: auto;
}
</style>

<style>
            #container {
                width: 1000px;
                margin: 20px auto;
            }
            .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }
            .ck-content .image {
                /* block images */
                max-width: 80%;
                margin: 20px auto;
            }
        </style>
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
          
            $('#basicModal').modal('hide');
        });
       
</script>