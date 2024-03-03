<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Exceptions\NoAvailableSlotException;


    class AppointmentController extends Controller
    {
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'timerange' => 'required|date_format:m/d/Y',
            'daytime' => 'required|date_format:H:i',
        ]);

        try {
            // Format datetime values before saving to the database
            $timerange = \Carbon\Carbon::createFromFormat('m/d/Y', $request->input('timerange'))->format('Y-m-d');
            $daytime = $request->input('daytime');

            // Create a new appointment instance and save it to the database
            $appointment = new Appointment([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'timerange' => $timerange,
                'daytime' => $daytime,
            ]);

            // Save the appointment to the database
            $appointment->save();

            // Check for available slots after saving to the database
            $appointmentDateTime = $this->findAvailableSlot($timerange, $daytime);

            // Update the appointment with actual values for timerange and daytime
            $appointment->timerange = $timerange;
            $appointment->daytime = $daytime;
            $appointment->save();

            $availabilityMessage = "Slot is available at $appointmentDateTime.";
        } catch (\Exception $exception) {
            // Handle exceptions, such as duplicate entries
            $availabilityMessage = $exception->getMessage();
        }

        return view('form', ['availabilityMessage' => $availabilityMessage]);
    }

    private function findAvailableSlot($timerange, $daytime)
    {
        $startTime = now()->setHour(9)->setMinute(0);
        $endTime = now()->setHour(17)->setMinute(0);

        $existingAppointments = Appointment::where(function ($query) {
            $query->whereNotNull('timerange')
                ->whereNotNull('daytime')
                ->orWhereNull('timerange')
                ->orWhereNull('daytime');
        })->whereBetween('appointment_datetime', [$startTime, $endTime])
            ->orWhere(function ($query) use ($timerange, $daytime) {
                $query->where('timerange', '=', $timerange)
                    ->where('daytime', '=', $daytime);
            })
            ->get();

        $currentDateTime = $startTime;
        while ($currentDateTime <= $endTime) {
            $slotIsAvailable = $existingAppointments->every(function ($appointment) use ($currentDateTime, $timerange, $daytime) {
                if (is_null($appointment->timerange) && is_null($appointment->daytime)) {
                    return true; // Treat appointments with NULL values as available
                }
                return !($appointment->timerange == $timerange && $appointment->daytime == $daytime);
            });

            if ($slotIsAvailable) {
                return $currentDateTime;
            }

            $currentDateTime = $currentDateTime->addHour(1); // Change this line to add 1 hour
        }

        throw new NoAvailableSlotException('No available slots within the specified time range.');
    }

    // ...
}
