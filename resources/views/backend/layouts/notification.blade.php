
@if(session('success'))
    <div class="alert alert-success alert-dismissible show fade" role="alert">
        <button class="close" data-dismiss="alert"><span>&times;</span></button>
        <div class="alert-body">
            {{session('success')}}            
        </div>
    </div>

@elseif(session('error'))

    <div class="alert alert-danger alert-dismissible show fade" role="alert">
        <button class="close" data-dismiss="alert"><span>&times;</span></button>
        <div class="alert-body">
            {{session('error')}}    
        </div>
    </div>
@endif
