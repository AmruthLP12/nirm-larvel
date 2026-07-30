<section class="contact-form-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {!! Form::open(['route' => 'public.send.contact', 'method' => 'POST', 'class' => 'contact-form']) !!}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="d-flex flex-column">
                                    <label for="name">First Name*</label>
                                    <input type="text" class="input-field" value="{{old('first_name')}}" name="first_name" id="fname" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="d-flex flex-column">
                                    <label for="name">Last Name*</label>
                                    <input type="text" class="input-field" value="{{old('last_name')}}" name="last_name" id="lname" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="d-flex flex-column">
                                    <label for="email">Email*</label>
                                    <input type="email" class="input-field" value="{{old('email')}}" name="email" id="email" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="d-flex flex-column">
                                    <label for="tel">Phone Number*</label>
                                    <input type="tel" class="input-field" value="{{old('phone_number')}}" name="phone_number" id="tel">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <p>Please provide us with any questions/comments you may have here*</p>

                                <textarea name="comments" id="text_area" cols="100" rows="10"
                                    class="w-100 input-field" required>{{old('comments')}}</textarea>
                            </div>
                             @if (setting('enable_captcha') && is_plugin_active('captcha'))
                                <div class="col-lg-12">
                                    <div class="d-flex flex-column">
                                        {!! Captcha::display() !!}
                                    </div>
                                </div>
                            @endif
                        </div>   
                        
                        <div class="btn-wrapper mb-4 mt-2">
                            <button type="submit" class="theme-btn text-center">Submit</button>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-message contact-success-message" style="display: none"></div>
                                <div class="contact-message contact-error-message" style="display: none"></div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
