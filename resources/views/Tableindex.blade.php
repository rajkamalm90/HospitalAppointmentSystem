@extends('layouts.app')

@section('content')

        <style>
            body {
                background-image: url('assets/pk.jpg'); 
                background-size: 300px;
                background-position: center;
                color: #ffffff; 
                margin-top: 50px;
            }
    
            .container {
                margin-top: 50px; 
            }
    
            .table-container {
                background-color: rgba(0, 0, 0, 0.7); 
                padding: 20px;
                border-radius: 10px;
            }
        </style>
        <title>user Details</title>
    </head>

<body>

<div class="container">
    <div class="table-container">
        <header class="modal-header">
            <h1>Contact Details</h1>
        </header>

        @if(session('message'))
            {{ session('message') }}
        @endif

        @isset($details)
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-white">
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                    @foreach($details as $info)
                        <tr>
                            <td>
                                <a href="{{ url('/edit', $info->id) }}"><button class="btn btn-sm btn-warning">Edit</button></a> 
                                <a href="{{ url('/delete', $info->id) }}" onclick="return confirm('Are you sure want to delete this?')"><button class="btn btn-sm btn-danger">Delete</button></a>
                            </td>
                            <td>{{ $info->name }}</td>
                            <td>{{ $info->email }}</td>
                            <td>{{ $info->phone }}</td>
                            <td>{{ $info->subject }}</td>
                            <td>{{ $info->message }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endisset
    </div>
</div>
@endsection
    