<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
   <div class="appointment-form">

      <h3><span>+</span> Book Appointment</h3>
      
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
   <div class="form">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                     <div class="form-group">
         <label for="name">Name:</label>
                  <input type="text" name="name" placeholder="name"   class="form-control"  required>
                 </div>
              </div>

       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="row">
                  <div class="form-group">
      <label for="phonenumber">phonenumber:</label>
               <input type="text" name="phone" placeholder="phone"   class="form-control"  required>
              </div>
           </div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="row">
                      <div class="form-group">
          <label for="timerange">Time Range (mm/dd/yyyy):</label>
                   <input type="text" name="timerange" placeholder="mm/dd/yyyy"   class="form-control"  required>
                  </div>
               </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="row">
                  <div class="form-group">
      <label for="timerange">Daytime(H:M):</label>
               <input type="text" name="Daytime" placeholder="H:I"   class="form-control"  required>
              </div>
           </div>
        </div>
         
      <div class="row">
            <div class="form-group">
        <center> <button type="submit" class="btn btn-primary">Submit</button></center>

            </div>
         </div>
      
         </form>
      </div>
   </div>
</div>
