<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts; // Assuming your model is named Contact

class ContactUsController extends Controller
{
    // Show the form
    public function form()
    {
        return view('contact');
    }

    // Handle form submission

    //dd($request->all())  data print
    
    public function data_submit(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
    
        // Get form data
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $message = $request->input('message');
    
        // Create a new Contact model instance
        $contacts = new Contacts;
        // Fill the model with data
        $contacts->name = $name;
        $contacts->email = $email;
        $contacts->phone = $phone;
        $contacts->subject = $subject;
        $contacts->message = $message;
    
        try {
            // Save the data to the database
            $result = $contacts->save();
        } catch (\Exception $e) {
            // Handle any exceptions (e.g., database errors)
            return redirect('/contact')->with(['message' => 'Error saving data: ' . $e->getMessage()]);
        }
    
        if ($result) {
            return redirect('/contact')->with(['message' => 'Successfully submitted']);
        } else {
            return redirect('/contact')->with(['message' => 'Not submitted']);
        }
    }
    

    // Fetch all data
    public function data_fetch()
    {
        $allData = Contacts::get();
        return view('Tableindex')->with(['details' => $allData]);
    }

    // Edit data
    public function data_edit($id)
    {
        $editInfo = Contacts::find($id);
        return view('edit')->with(['edit_details' => $editInfo]);
    }

    // Update data
    public function data_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $updateId = $request->input('hidden_id');

        try {
            $affectedRows = Contacts::whereId($updateId)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'subject' => $subject,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return redirect('/getall')->with(['message' => 'Error updating data: ' . $e->getMessage()]);
        }

        if ($affectedRows) {
            return redirect('/getall')->with(['message' => 'Successfully updated']);
        } else {
            return redirect('/getall')->with(['message' => 'Nothing updated']);
        }
    }

    // Delete data
    public function data_delete($id)
    {
        $deleteInfo = Contacts::whereId($id)->delete();
        if ($deleteInfo) {
            return redirect('/getall')->with(['message' => 'Successfully deleted']);
        } else {
            return redirect('/getall')->with(['message' => 'Not deleted']);
        }
    }
}
