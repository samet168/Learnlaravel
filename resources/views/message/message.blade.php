<div class="card-body">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                
                <h5>{{ session('status') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                
                <h5>{{ session('status') }}</h5>
                {{-- <h3>invoice password or email is incorrect</h3> --}}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
</div>

