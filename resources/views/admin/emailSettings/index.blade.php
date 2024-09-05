@extends('layouts.auth')
@section('title', 'Email Settings | Admin')
@section('styles')
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="http://datatables.net/release-datatables/media/js/jquery.js"></script>
    <script src="http://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
    <script src="http://datatables.net/release-datatables/extensions/Scroller/js/dataTables.scroller.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
               <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                              <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Email Setting</li>
                        </ol>
                    </nav>
                 </div>
            </div>
            
                <div class="card card-default">
                    <div class="card-header">
                        @if (count($emailSettings) > 0)
                          <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                      <th scope="col">Action</th>
                                        <th scope="col">Host</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Port</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = ($emailSettings->currentPage() - 1) * $emailSettings->perPage() + 1;
                                    @endphp
                                    @foreach ($emailSettings as $emailSetting)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            {{-- <td><input type="checkbox" class="selectCheckbox" name="selectedHeadersIds[]"
                                                    value="{{ $header->id }}"></td> --}}
                                            <td>
                                                <div class="d-flex flex-row">
                                                    <x-edit-action-button-component :editRoute="route('emailSettings.edit', $emailSetting->id)" :id="$emailSetting->id" />
                                                    <x-destroy-action-button-component :destroyRoute="route('emailSettings.destroy', $emailSetting->id)" :id="$emailSetting->id" />
                                                </div>
                                               
                                            </td>
                                            <td><x-status-component :status="$emailSetting->status" />
                                                {{ $emailSetting->host }}</td>
                                            <td>{{ $emailSetting->email }}</td>
                                            <td>{{ $emailSetting->port }}</td>
                                        </tr>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                <span>{{ $emailSettings->links() }}</span>

                            </div>
                        @else()
                            <h3 class="text-center text-danger">No Email Setting found</h3>
                        @endif
                    </div>
                </div>
          
        </div>
    </div>
    <script></script>
@endsection
