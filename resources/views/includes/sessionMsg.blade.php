
    @if (Session::has('err'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert"><em>{{Session::get('err')}}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"><em>{{Session::get('success')}}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert"><em>{{Session::get('warning')}}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif