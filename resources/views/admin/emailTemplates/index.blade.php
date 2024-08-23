@extends('layouts.auth')

@section('title', 'Email Templates | Admin')

@section('styles')
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="content-wrapper">
  <div class="content">
    <div class="card card-default">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Email Templates</li>
          </ol>
        </nav>
      </div>
    </div>
<div class="card card-default">
      <div class="card-header">
        {{-- Create --}}
        <button type="button" class="mb-3 btn btn-lg btn-outline-primary" data-toggle="modal" data-target="#emailTemplateCreate">
          <i class="mdi mdi-star-outline"></i> New Email Template
        </button>
        <x-email-template-create-component/>
        

        @if (count($emailTemplates) > 0)
        <table class="table table-striped" id="emailTemplates" width="100%">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Actions</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
              <th scope="col">Subject</th>
              <th scope="col">Body</th>
            </tr>
          </thead>
          <tbody>
            @php $count = ($emailTemplates->currentPage() - 1) * $emailTemplates->perPage() + 1; @endphp
            @foreach ($emailTemplates as $emailTemplat)
            <tr>
              <td>{{ $count }}</td>
              <td>
                <x-action-button destroyRoute="{{ route('emailTemplates.destroy', $emailTemplat->id) }}" editRoute="{{ route('emailTemplates.edit', $emailTemplat->id) }}" id="{{ $emailTemplat->id }}" entityType="emailTemplat">
                </x-action-button>
              </td>
              <td>
                <x-status-component :status="$emailTemplat->status" />{{ $emailTemplat->name }}
              </td>
              <td>{{ $emailTemplat->action ?? '' }}</td>
              <td>{{ $emailTemplat->subject ?? '' }}</td>
              <td>{{ $emailTemplat->body ?? '' }}</td>
             
              
            </tr>
            @php $count++; @endphp
            @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          <span>{{ $emailTemplates->links() }}</span>
        </div>
        @else
        <div class="row text-center">
          <h3 class="text-danger">No Email Templates found!</h3>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection