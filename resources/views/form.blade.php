<!-- resources/views/appointment/form.blade.php -->
@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <div class="card" style="background-color: SlateBlue;">
            <div class="card-body">
                
                @if(isset($availabilityMessage))
                    <div class="alert alert-info mt-3">
                        <p>{{ $availabilityMessage }}</p>
                    </div>
                @endif

                <!-- Display matching entries if no available slot is found -->
                @if(isset($matchingAppointments) && count($matchingAppointments) > 0)
                    <div class="alert alert-warning mt-3">
                        <p>Matching entries in the database:</p>
                        <ul>
                            @foreach($matchingAppointments as $matchingAppointment)
                                <li>
                                    {{ $matchingAppointment->name }} - 
                                    {{ $matchingAppointment->phone }} - 
                                    {{ $matchingAppointment->appointment_datetime }} - 
                                    {{ $matchingAppointment->timerange ?? 'NULL' }} - 
                                    {{ $matchingAppointment->daytime ?? 'NULL' }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/appointment" method="post">
                    @csrf
                    <h1>Please fill</h1>
                    <div style="margin-bottom: 15px;">
                        <label for="name">Name:</label>
                        <input type="text" style="width: 75%; padding: 8px;" name="name" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="phone">Phone:</label>
                        <input type="text" style="width: 75%; padding: 8px;" name="phone" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="timerange">Timeduresion </label>
                        <input type="text" style="width: 70%; padding: 8px;" name="timerange" placeholder="mm/dd/yyyy" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="daytime">Daytime</label>
                        <input type="text" style="width: 75%; padding: 8px;" name="daytime" placeholder="H:i" required>
                    </div>

                    <button type="submit" style="background-color: #007bff; color: #fff; padding: 10px; border: none;">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
