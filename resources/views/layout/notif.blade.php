@if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <span class="close" data-bs-dismiss="alert" aria-label="Close" style="position:absolute;top:10px;right:10px;font-size:1.3rem;cursor:pointer;">&times;</span>
                 </div>
@endif

