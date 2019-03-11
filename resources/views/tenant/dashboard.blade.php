@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard for x</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($projects as $project)
                        <a href="{{ route('projects.show', $project)}}" class="list-group-item">{{ $project->name }}</a>
                    @endforeach
                   
                </div>
                <div class="card-header">New Project</div>
                <div class="card-body">                   
                    @include('tenant.projects.partials._create')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
