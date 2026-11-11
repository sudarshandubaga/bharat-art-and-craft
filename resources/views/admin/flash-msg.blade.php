@if($errors->any())
    <div class="alert alert-modern alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="flex-grow-1">
            <strong>Please check the following errors:</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(\Session::has('success') || \Session::has('sucess'))
    @php $msg = \Session::get('success') ?? \Session::get('sucess'); @endphp
    <div class="alert alert-modern alert-success alert-dismissible fade show" role="alert">
        <div class="alert-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="flex-grow-1">
            <div class="fw-bold">{{ $msg }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(\Session::has('danger') || \Session::has('error'))
    @php $errMsg = \Session::get('danger') ?? \Session::get('error'); @endphp
    <div class="alert alert-modern alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-icon">
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <div class="flex-grow-1">
            <div class="fw-bold">{{ $errMsg }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif