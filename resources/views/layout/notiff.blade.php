@if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <span class="close" data-bs-dismiss="alert" aria-label="Close" style="position:absolute;top:10px;right:10px;font-size:1.3rem;cursor:pointer;">&times;</span>
                 </div>
@endif


@if ($errors->any())
  <div class="alert alert-danger" role="alert" style="position:relative;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <span class="close" data-bs-dismiss="alert" aria-label="Close" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:1.3rem;">&times;</span>
  </div>   
@endif