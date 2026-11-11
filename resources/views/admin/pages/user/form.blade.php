@include('admin.flash-msg')

<div class="row g-4 justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0">
                    <i class="bi bi-person-badge text-primary"></i> User Profile Details
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-2">
                        {{ Form::label('title', 'Salutation', ['class' => 'form-label']) }}
                        {{ Form::select('title', ['Mr.' => 'Mr.', 'Ms.' => 'Ms.', 'Mrs.' => 'Mrs.'], 'Mr.', ['class' => 'form-select', 'required' => 'required']) }}
                    </div>
                    <div class="col-md-5">
                        {{ Form::label('first_name', 'First Name', ['class' => 'form-label']) }}
                        {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => 'required']) }}
                    </div>
                    <div class="col-md-5">
                        {{ Form::label('last_name', 'Last Name', ['class' => 'form-label']) }}
                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => 'required']) }}
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        {{ Form::label('email', 'Email Address', ['class' => 'form-label']) }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'user@example.com', 'required' => 'required']) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('phone', 'Phone Number', ['class' => 'form-label']) }}
                        {{ Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => '+91-9876543210']) }}
                    </div>
                </div>

                <div class="mb-3">
                    {{ Form::label('password', 'Account Password', ['class' => 'form-label']) }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => !empty($user->id) ? 'Leave blank to retain current password' : 'Enter Password']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('about', 'About / Bio', ['class' => 'form-label']) }}
                    {{ Form::text('about', null, ['class' => 'form-control', 'placeholder' => 'Brief description about user']) }}
                </div>

                <div class="mb-4">
                    {{ Form::label('description', 'Additional Notes', ['class' => 'form-label']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Internal notes or details...']) }}
                </div>

                <hr class="my-4">

                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-light border px-4">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ !empty($user->id) ? 'Update User' : 'Save User' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>