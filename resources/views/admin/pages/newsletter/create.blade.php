@extends('admin.layouts.inner')

@section('site_title','Add News letter')

@section('main_section')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style="margin-top: 41px;">Add Newsletter</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.newsletter.index')}}">News letter</a>
                </li>
                <li class="breadcrumb-item active">Add News letter</li>
            </ol>
        </div>
        <div class="card-body">
            {{ Form::open([
                'url' => route('admin.newsletter.store'),
                'files' => true, 
                'method' => 'post'
                ]) }}

            <div class="row">
                <div class="col-3">
                 <h1>E-mails</h1>                
                

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Default checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        Checked checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        Checked checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        Checked checkbox
                    </label>
                </div>
                </div>
                
                <div class="col-7">
                <h1>Subject</h1>

                <div class="mb-3">
                    {{ Form::label('message', 'Message', ['class' => 'form-label']) }}
                    {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Enter message', 'required' => 'required']) }}
                </div>
                
                <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

</div>
@endsection
