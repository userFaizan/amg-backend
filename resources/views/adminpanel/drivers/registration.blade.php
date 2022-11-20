@extends('partials.master')
@section('content')
<div class="main-content">

    <div class="page-content">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="container-fluid">
             <div class="row align-items-center">
                 <div class="col-sm-6">
                     <div class="page-title">
                         <h4>Register Driver</h4>
                             <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a href="javascript: void(0);">Drivers</a></li>
                                 {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Add </a></li> --}}
                                 <li class="breadcrumb-item active">Register Driver</li>
                             </ol>
                     </div>
                 </div>
                 <div class="col-sm-6">
                    <div class="float-end d-none d-sm-block">
                        <a href="{{ route('driver.driverlist') }}" class="btn btn-success">Back</a>
                    </div>
                 </div>
             </div>
            </div>
         </div>
         <!-- end page title -->    


        <div class="container-fluid">

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Add Driver Info </h4>
                                <p class="card-title-desc"></p>
                                {{-- <form  method="post" action="{{ route('register.custom') }}">
                                    @csrf
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                                      <input type="email"  name= "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="exampleInputPassword1" class="form-label">Password</label>
                                      <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3 form-check">
                                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </form> --}}
                                  @if(session()->has('message'))
                                  <div class="alert alert-success">
                                      {{ session()->get('message') }}
                                  </div>
                              @endif
                                <form method="post" action="{{ route('register.custom') }}">
                                    @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name" placeholder="Enter Your Name" id="example-text-input">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    </div>
                                </div>
                              
                                <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" name="email" placeholder="Enter Your Email" id="example-email-input">
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif  
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-url-input" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password" placeholder="Enter Your Password" id="example-url-input">
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-tel-input" class="col-sm-2 col-form-label">Id Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="id_no" placeholder="Enter Id Number" id="example-tel-input">
                                        @if ($errors->has('id_no'))
                                        <span class="text-danger">{{ $errors->first('id_no') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-password-input" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="tel" name="phone_number" placeholder="Enter Phone Number"  value="" id="example-tel-input">
                                        @if ($errors->has('phone_number'))
                                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-number-input" class="col-sm-2 col-form-label">Latitude</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="lat" placeholder="Enter Latitude"   value="" id="example-number-input">
                                        @if ($errors->has('lat'))
                                        <span class="text-danger">{{ $errors->first('lat') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-number-input" class="col-sm-2 col-form-label">Longitude</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="lng" placeholder="Enter Longitude" value="" id="example-number-input">
                                        @if ($errors->has('lng'))
                                        <span class="text-danger">{{ $errors->first('lng') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-date-input" class="col-sm-2 col-form-label">License Expiry</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="l_expiry"  id="example-date-input">
                                        @if ($errors->has('l_expiry'))
                                        <span class="text-danger">{{ $errors->first('l_expiry') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>

                            </form>
                          
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                {{-- <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Sizing</h4>
                                <p class="card-title-desc">Set heights using classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.</p>
                                <div>
                                    <div class="mb-4">
                                        <input class="form-control" type="text" placeholder="Default input">
                                    </div>
                                    <div class="mb-4">
                                        <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
                                    </div>
                                    <div>
                                        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Range Inputs</h4>
                                <p class="card-title-desc">Set horizontally scrollable range inputs using <code>.form-control-range</code>.</p>

                                <div>
                                    <h5 class="font-size-14">Example</h5>
                                    <input type="range" class="form-range" id="formControlRange">
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14">Custom Range</h5>
                                    <input type="range" class="form-range" id="customRange1">

                                    <input type="range" class="form-range mt-3" min="0" max="5" id="customRange2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- end row -->

                {{-- <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-4">Checkboxes</h4>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div>
                                            <h5 class="font-size-14 mb-4">Form Checkboxes</h5>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="formCheck1">
                                                <label class="form-check-label" for="formCheck1">
                                                    Form Checkbox
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="formCheck2" checked>
                                                <label class="form-check-label" for="formCheck2">
                                                    Form Checkbox checked
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ms-auto">
                                        <div class="mt-4 mt-lg-0">
                                            <h5 class="font-size-14 mb-4">Form Checkboxes Right</h5>
                                            <div>
                                                <div class="form-check form-check-right mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheckRight1">
                                                    <label class="form-check-label" for="formCheckRight1">
                                                        Form Checkbox Right
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-check form-check-right">
                                                    <input class="form-check-input" type="checkbox" id="formCheckRight2"
                                                        checked>
                                                    <label class="form-check-label" for="formCheckRight2">
                                                        Form Checkbox Right checked
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-4">Radios</h4>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div>
                                            <h5 class="font-size-14 mb-4">Form Radios</h5>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="formRadios"
                                                    id="formRadios1" checked>
                                                <label class="form-check-label" for="formRadios1">
                                                    Form Radio
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="formRadios"
                                                    id="formRadios2">
                                                <label class="form-check-label" for="formRadios2">
                                                    Form Radio checked
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ms-auto">
                                        <div class="mt-4 mt-lg-0">
                                            <h5 class="font-size-14 mb-4">Form Radios Right</h5>
                                            <div>
                                                <div class="form-check form-check-right mb-3">
                                                    <input class="form-check-input" type="radio" name="formRadiosRight"
                                                        id="formRadiosRight1" checked>
                                                    <label class="form-check-label" for="formRadiosRight1">
                                                        Form Radio Right
                                                    </label>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="form-check form-check-right">
                                                    <input class="form-check-input" type="radio" name="formRadiosRight"
                                                        id="formRadiosRight2">
                                                    <label class="form-check-label" for="formRadiosRight2">
                                                        Form Radio Right checked
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> --}}
                <!-- end row -->

                {{-- <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Switches</h4>
                                <p class="card-title-desc">A switch has the markup of a custom checkbox but uses the <code>.form-switch</code> class to render a toggle switch. Switches also support the <code>disabled</code> attribute.</p>
                                <div class="form-check form-switch mb-3" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="customSwitch1" checked>
                                    <label class="form-check-label" for="customSwitch1">Toggle this switch element</label>
                                </div>
                                <div class="form-check form-switch" dir="ltr">
                                    <input type="checkbox" class="form-check-input" disabled id="customSwitch2">
                                    <label class="form-check-label" for="customSwitch2">Disabled switch element</label>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">File browser</h4>
                                <p class="card-title-desc">The file input is the most gnarly of the bunch and requires additional JavaScript if you’d like to hook them up with functional <em>Choose file…</em> and selected file name text.</p>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="customFile">
                                </div>
                            </div>
                        </div>

                    </div>
                </div> --}}
                <!-- end row -->

            </div>

            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

  
    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Morvin.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection