@if (session()->has('success'))
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-success mx-5 mt-3">
                <div class="card-header">
                    <h3 class="card-title">Success</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('error_string'))
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-danger mx-5 mt-3">
                <div class="card-header">
                    <h3 class="card-title"> Whoops!</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{ session()->get('error_string') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-danger mx-5 mt-3">
                <div class="card-header">
                    <h3 class="card-title"> Whoops!</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <hr>
                    Please fix following problem(s)
                    <ul style="margin-top: 10px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
