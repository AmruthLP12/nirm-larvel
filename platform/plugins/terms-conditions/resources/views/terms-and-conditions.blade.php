<!DOCTYPE html>
<html lang="en-IN">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Application Form - NIRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('plugins/terms-conditions::style')
    <link href=" https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/src/parsley.min.css " rel="stylesheet">
</head>

<body>

    <div class="container">

        <div class="header-content">
            <h2 class="western institute-name hindi">
                राष्ट्रीय शिला यांत्रिकी संस्थान <br>
                NATIONAL INSTITUTE OF ROCK MECHANICS
            </h2>

            <p class="address-info">
                (An Autonomous Research Institute under Ministry of Mines, Govt of India)
            </p>
            <p class="address-info">
                HEAD OFFICE, OUTER RING ROAD, ESHWAR NAGAR, BSK-II STAGE, BENGALURU-560 070
            </p>
            <div class="contact-info">
                <p>Website: <a href="https://www.nirm.in/">https://www.nirm.in</a> e-mail: <a
                        href="mailto:dto@nirm.in">dto@nirm.in</a></p>
                <p>Phone: 080-26934400 (Director); Other #080-269344 02 to 14 Fax: 080-26934401</p>
            </div>
        </div>

        <hr />

        <section class="notification-section">
            <h2>NOTIFICATION NO. ADVT/01/2025-26 dated 04-7-2025</h2>
            <h3>Terms and conditions:</h3>
            <ul>
                <li>Candidates should apply ONLINE only.</li>
                <li>The candidate must be a citizen of India.</li>
                <li>The appointments are on regular basis with a probation period of 2 years.</li>
                <li>Crucial date for claim of SC/ ST/ OBC (As per Govt. of India list) status or any other benefit viz.
                    reservation, age-relaxation, etc., where not specified otherwise, will be the closing date for
                    receipt of applications.</li>
                <li>A person seeking appointment on the basis of reservation to OBC /SC / ST must ensure that he
                    possesses the relevant certificate on the crucial date. Candidates may also note that in respect of
                    the above, their candidature will remain provisional till the veracity of the concerned document is
                    verified by the Institute. The candidates claim benefit of reservation under EWS are required to
                    submit the Income and Asset Certificate (I & AC) in the prescribed format issued by a Competent
                    Authority.</li>
                <li>Age relaxation is applicable for SC / ST/ OBC candidates as per the Govt. of India norms.</li>
                <li>The prescribed qualifications are the minimum required and the mere fact that a candidate possesses
                    the same will not entitle for shortlisting of their candidature.</li>
                <li>Application fee (non-refundable) of Rs.1000/- is payable. SC/ST candidates are exempted from payment
                    of application fee.</li>
                <li>Persons employed in Central/ State Government/ PSUsI Universities/ Autonomous Bodies required to
                    upload the endorsement in prescribed format from their employer or an undertaking that NOC will be
                    submitted at the time of interview.</li>
                <li>Selection of candidate will be made based on a personal interview of the short-listed candidates by
                    a designated selection committee at the Institute. Mere fulfilling the minimum qualifications and
                    experience will not vest any right on a candidate for being called for interview.</li>
                <li>The Institute reserves the right to reject any application without assigning any reason. The
                    Institute also reserves the right to cancel the advertisement/ recruitment process at any stage due
                    to administrative reason. No correspondence will be entertained in this regard.</li>
                <li>The Institute reserves the right to verify the antecedents and documents submitted by the candidate.
                    In case it is found that the documents submitted by the candidate are not genuine, then the services
                    shall be terminated after due process, and disciplinary/criminal proceedings will be initiated
                    against such candidates even after appointment.</li>
                <li>The last date for receipt of applications is ________.</li>
                <li>Courts’ Jurisdiction: Any dispute in regard to this recruitment will be subject to the courts in
                    Bengaluru.</li>
            </ul>
            <p>Note: Any updates in this regard can be downloaded from the NIRM’s website (<a
                    href="https://nirm.in">https://nirm.in</a>).</p>
        </section>

        <h2 class="western" align="center">APPLICATION FORM</h2>

        {{-- message --}}
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('public.job-application.store') }}" method="post" enctype="multipart/form-data"
            data-parsley-validate>
            @csrf

            <div class="form-group">
                <label for="application_no">Application No. (Auto-generated):</label>
                <input type="text" id="application_no" name="application_no"
                    value="NIRM/2025-26/No.-[Auto-generated]" readonly>
                <span class="note">This number will be automatically generated upon successful submission.</span>
            </div>

            <div class="form-group">
                <label for="post_applied_for">1. Application for the Post of:</label>
                <select id="post_applied_for" name="post_applied_for" required>
                    <option value="" {{ old('post_applied_for') == '' ? 'selected' : '' }}>Select a Post</option>
                    <option value="Scientist-1" {{ old('post_applied_for') == 'Scientist-1' ? 'selected' : '' }}>Scientist-1</option>
                    <option value="Administrative Officer" {{ old('post_applied_for') == 'Administrative Officer' ? 'selected' : '' }}>Administrative Officer</option>
                </select>
            </div>

            <div id="Frame1">
                <p>Upload Your passport size photograph here </p>
                <p><label for="passport_photo">Upload Photo</label> <input type="file" id="passport_photo"
                        name="passport_photo" accept="image/*" data-parsley-fileextension="jpg,jpeg,png"
                        data-parsley-fileextension-message="Please upload a valid image file (jpg, jpeg, png)."
                        required></p>
            </div>

            <div class="form-group">
                <label for="full_name">2. Name (in BLOCK LETTERS):</label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                <span class="note">(Female applicants to prefix Ms.)</span>
            </div>

            <div class="form-group">
                <label>3. Gender:</label>
                <div class="input-group">
                    <input type="radio" data-parsley-required="true" id="gender_male" name="gender" value="Male"
                        {{ old('gender') == 'Male' ? 'checked' : '' }}><label for="gender_male">Male</label>
                    <input type="radio" data-parsley-required="true" id="gender_female" name="gender" value="Female"
                        {{ old('gender') == 'Female' ? 'checked' : '' }}><label for="gender_female">Female</label>
                    <input type="radio" data-parsley-required="true" id="gender_other" name="gender" value="Other"
                        {{ old('gender') == 'Other' ? 'checked' : '' }}><label for="gender_other">Other</label>
                </div>
            </div>

            <div class="form-group">
                <label for="father_name">4. Father's Name:</label>
                <input type="text" data-parsley-required="true" id="father_name" name="father_name"
                    value="{{ old('father_name') }}">
            </div>

            <div class="form-group">
                <label for="category">5. Category (General/SC/ ST/OBC/EWS/PH/Other(specify)):</label>
                <div class="input-group">
                    <select id="category" name="category" data-parsley-required="true" required>
                        <option value="" {{ old('category') == '' ? 'selected' : '' }}>Select a category</option>
                        <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                        <option value="SC" {{ old('category') == 'SC' ? 'selected' : '' }}>SC</option>
                        <option value="ST" {{ old('category') == 'ST' ? 'selected' : '' }}>ST</option>
                        <option value="OBC" {{ old('category') == 'OBC' ? 'selected' : '' }}>OBC</option>
                        <option value="EWS" {{ old('category') == 'EWS' ? 'selected' : '' }}>EWS</option>
                        <option value="OTHER" {{ old('category') == 'OTHER' ? 'selected' : '' }}>Other (specify)</option>
                    </select>
                    <input type="text" name="other_category_specify" id="other_category_specify"
                        placeholder="Specify if OTHER" value="{{ old('other_category_specify') }}"
                        data-parsley-requiredother="#category">

                </div>
                <label for="caste_certificate">Upload Caste Certificate:</label>
                <input type="file" id="caste_certificate" name="caste_certificate" accept="application/pdf,image/*"
                    data-parsley-fileextension="pdf,jpg,jpeg,png"
                    data-parsley-fileextension-message="Please upload a valid file (pdf, jpg, jpeg, png)."
                    data-parsley-required="true">
                <span class="note">(Please attach appropriate certificate, if you belong to reserved category)</span>
            </div>

            <div class="form-group">
                <label for="dob">6. (a) Date of birth:</label>
                <input type="date" id="dob" name="dob" value="{{ old('dob') }}"
                    data-parsley-required="true" required>
                <label for="birth_certificate">Upload Birth Certificate/SSC Marks Card:</label>
                <input type="file" id="birth_certificate" name="birth_certificate"
                    data-parsley-fileextension="pdf,jpg,jpeg,png"
                    data-parsley-fileextension-message="Please upload a valid file (pdf, jpg, jpeg, png)."
                    data-parsley-required="true" accept="application/pdf,image/*">
                <span class="note">(Enclose proof in support of date of birth)</span>
            </div>
            <div class="form-group">
                <label for="place_of_birth">(b) Place of birth:</label>
                <input type="text" id="place_of_birth" name="place_of_birth" data-parsley-required="true"
                    value="{{ old('place_of_birth') }}">
            </div>

            <div class="form-group">
                <p>(c) Marital Status:</p>
                <div class="input-group">
                    <input data-parsley-required="true" type="radio"
                        {{ old('marital_status') == 'Married' ? 'checked' : '' }} id="marital_married"
                        name="marital_status" value="Married"><label for="marital_married">Married</label>
                    <input data-parsley-required="true" type="radio"
                        {{ old('marital_status') == 'Single' ? 'checked' : '' }} id="marital_single"
                        name="marital_status" value="Single"><label for="marital_single">Single</label>
                    <span class="note">(Strike off the option not applicable)</span>
                </div>
            </div>

            <div class="form-group">
                <label for="communication_address">7. (a) Address for communication:</label>
                <textarea id="communication_address" name="communication_address" rows="3" data-parsley-required="true">{{ old('communication_address') }}</textarea>
                <span class="note">Any change in address after submission of application form should be notified to
                    this office immediately.</span>
            </div>

            <div class="form-group">
                <label for="permanent_address">(b) Permanent address:</label>
                <textarea id="permanent_address" name="permanent_address" rows="3" data-parsley-required="true">{{ old('permanent_address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="contact_phone">c) Contact phone No:</label>
                <input type="tel" id="contact_phone" name="contact_phone" data-parsley-required="true"
                data-parsley-type="number"
                     maxlength=" 15" value="{{ old('contact_phone') }}">
            </div>

            <div class="form-group">
                <label for="email_id">(d) e-mail id:</label>
                <input type="email" id="email_id" name="email_id" required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    title="Please enter a valid email address (e.g., 	example@domain.com)"
                    value="{{ old('email_id') }}">
            </div>

            <div class="form-group">
                <label for="nationality">8. Nationality:</label>
                <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}"
                    data-parsley-required="true">
            </div>

            <div class="form-group">
                <p> If you are a person of Indian origin, please state (strike off the option not applicable)</p>
                <div class="form-row">
                    <p>(a) Whether a citizen of India by birth ?:</p>
                    <input data-parsley-required="true" type="radio" id="citizen_india_yes" name="citizen_india"
                        value="1"><label for="citizen_india_yes">YES</label>
                    <input data-parsley-required="true" type="radio" id="citizen_india_no" name="citizen_india"
                        value="0"><label for="citizen_india_no">NO</label>
                </div>
                <div id="belong_state_group" class="form-row">
                    <label for="belong_state">If yes, then state to which you belong:</label>
                    <input type="text" id="belong_state" name="belong_state" value="{{ old('belong_state') }}">
                </div>
                <div class="form-row">
                    <p>(b) Whether a person migrated from Pakistan/ Bangladesh:</p>
                    <input data-parsley-required="true" type="radio" id="migrated_yes"
                        {{ old('migrated') == '1' ? 'checked' : '' }} name="migrated" value="1"><label
                        for="migrated_yes">YES</label>
                    <input data-parsley-required="true" type="radio" id="migrated_no"
                        {{ old('migrated') == '0' ? 'checked' : '' }} name="migrated" value="0"><label
                        for="migrated_no">NO</label>
                </div>
                <div class="form-row">
                    <p>(c) Whether a subject of Nepal?:</p>
                    <input data-parsley-required="true" type="radio" id="nepal_sikkim_yes"
                        {{ old('nepal_sikkim') == '1' ? 'checked' : '' }} name="nepal_sikkim" value="1"><label
                        for="nepal_sikkim_yes">YES</label>
                    <input data-parsley-required="true" type="radio" id="nepal_sikkim_no"
                        {{ old('nepal_sikkim') == '0' ? 'checked' : '' }} name="nepal_sikkim" value="0"><label
                        for="nepal_sikkim_no">NO</label>
                </div>
            </div>
            <div class="form-group">
                <label for="religion">9. (a) Religion to which you belong:</label>
                <input data-parsley-required="true" type="text" id="religion" name="religion"
                    value="{{ old('religion') }}">
            </div>

            <div class="form-group">
                <p>(b) Have you ever changed your religion:</p>
                <div class="input-group">
                    <input data-parsley-required="true" type="radio" id="religion_change_yes"
                        {{ old('religion_changed') == '1' ? 'checked' : '' }} name="religion_changed"
                        value="1"><label for="religion_change_yes">YES</label>
                    <input data-parsley-required="true" type="radio" id="religion_change_no"
                        {{ old('religion_changed') == '0' ? 'checked' : '' }} name="religion_changed"
                        value="0"><label for="religion_change_no">NO</label>
                </div>
            </div>


            <h3>10. Educational & Professional qualifications - (Start with SSLC/SSC)</h3>

            <div class="form-group">
                <p>Please Select your Basic Degree:</p>
                <div class="input-group">
                    <input data-parsley-required="true" type="radio" id="degree_science"
                        {{ old('basic_degree_type') == 'Science' ? 'checked' : '' }} name="basic_degree_type"
                        value="Science" onclick="toggleEducationTables()"><label for="degree_science">Science</label>
                    <input data-parsley-required="true" type="radio" id="degree_engineering"
                        {{ old('basic_degree_type') == 'Engineering' ? 'checked' : '' }} name="basic_degree_type"
                        value="Engineering" onclick="toggleEducationTables()"><label
                        for="degree_engineering">Engineering</label>
                </div>
            </div>

            <div id="scienceTable" style="display:none;">
                <h4>Science Degree Qualifications</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Exam Passed</th>
                            <th>Board/University</th>
                            <th>Duration of Study</th>
                            <th>Year of Passing</th>
                            <th>Major Subjects</th>
                            <th>Percent</th>
                            <th>CGPA</th>
                            <th>Upload Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="science_edu_exam_passed[]" value="SSC/SSLC"></td>
                            <td><input type="text" name="science_edu_board_uni[]"></td>
                            <td><input type="text" name="science_edu_duration[]"></td>
                            <td><input type="text" name="science_edu_year_passing[]"></td>
                            <td><input type="text" name="science_edu_major_subjects[]"></td>
                            <td><input type="number" name="science_edu_percent[]" step="0.01"></td>
                            <td><input type="number" name="science_edu_cgpa[]" step="0.01"></td>
                            <td><input type="file" name="science_edu_certificate[]"
                                    accept="application/pdf,image/*"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="science_edu_exam_passed[]" value="PUC"></td>
                            <td><input type="text" name="science_edu_board_uni[]"></td>
                            <td><input type="text" name="science_edu_duration[]"></td>
                            <td><input type="text" name="science_edu_year_passing[]"></td>
                            <td><input type="text" name="science_edu_major_subjects[]"></td>
                            <td><input type="number" name="science_edu_percent[]" step="0.01"></td>
                            <td><input type="number" name="science_edu_cgpa[]" step="0.01"></td>
                            <td><input type="file" name="science_edu_certificate[]"
                                    accept="application/pdf,image/*"></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="science_degree_type[]">
                                    <option value="">Degree</option>
                                    <option value="BSc-Geology">BSc-Geology</option>
                                    <option value="BSc-Applied-Geology">BSc-Applied-Geology</option>
                                    <option value="BSc-Geophysics">BSc-Geophysics</option>
                                    <option value="BSc-Applied-Geophysics">BSc-Applied-Geophysics</option>
                                    <option value="Others">Others</option>
                                </select>
                            </td>
                            <td><input type="text" name="science_edu_board_uni[]"></td>
                            <td><input type="text" name="science_edu_duration[]"></td>
                            <td><input type="text" name="science_edu_year_passing[]"></td>
                            <td><input type="text" name="science_edu_major_subjects[]"></td>
                            <td><input type="number" name="science_edu_percent[]" step="0.01"></td>
                            <td><input type="number" name="science_edu_cgpa[]" step="0.01"></td>
                            <td><input type="file" name="science_edu_certificate[]"
                                    accept="application/pdf,image/*"></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="science_post_graduate_type[]">
                                    <option value="">Post Graduate Degree</option>
                                    <option value="MSc-Geology">MSc-Geology</option>
                                    <option value="MSc-Geophysics">MSc-Geophysics</option>
                                    <option value="MPhil">MPhil</option>
                                    <option value="MSc-Tech">MSc-Tech</option>
                                    <option value="MTech">MTech</option>
                                    <option value="Others">Others</option>
                                </select>
                            </td>
                            <td><input type="text" name="science_edu_board_uni[]"></td>
                            <td><input type="text" name="science_edu_duration[]"></td>
                            <td><input type="text" name="science_edu_year_passing[]"></td>
                            <td><input type="text" name="science_edu_major_subjects[]"></td>
                            <td><input type="number" name="science_edu_percent[]" step="0.01"></td>
                            <td><input type="number" name="science_edu_cgpa[]" step="0.01"></td>
                            <td><input type="file" name="science_edu_certificate[]"
                                    accept="application/pdf,image/*"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="science_edu_exam_passed[]" value="PhD"></td>
                            <td><input type="text" name="science_edu_board_uni[]"></td>
                            <td><input type="text" name="science_edu_duration[]"></td>
                            <td><input type="text" name="science_edu_year_passing[]"></td>
                            <td><input type="text" name="science_edu_major_subjects[]"></td>
                            <td><input type="number" name="science_edu_percent[]" step="0.01"></td>
                            <td><input type="number" name="science_edu_cgpa[]" step="0.01"></td>
                            <td><input type="file" name="science_edu_certificate[]"
                                    accept="application/pdf,image/*"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="science_edu_exam_passed[]" value="Others"></td>
                            <td><input type="text" name="science_edu_board_uni[]"></td>
                            <td><input type="text" name="science_edu_duration[]"></td>
                            <td><input type="text" name="science_edu_year_passing[]"></td>
                            <td><input type="text" name="science_edu_major_subjects[]"></td>
                            <td><input type="number" name="science_edu_percent[]" step="0.01"></td>
                            <td><input type="number" name="science_edu_cgpa[]" step="0.01"></td>
                            <td><input type="file" name="science_edu_certificate[]"
                                    accept="application/pdf,image/*"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="engineeringTable" style="display:none;">
                <h4>Engineering Degree Qualifications</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Exam Passed</th>
                            <th>Board/University</th>
                            <th>Duration of Study</th>
                            <th>Year of Passing</th>
                            <th>Major Subjects</th>
                            <th>Percent</th>
                            <th>CGPA</th>
                            <th>Upload Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="eng_edu_exam_passed[]" value="SSC/SSLC"></td>
                            <td><input type="text" name="eng_edu_board_uni[]"></td>
                            <td><input type="text" name="eng_edu_duration[]"></td>
                            <td><input type="text" name="eng_edu_year_passing[]"></td>
                            <td><input type="text" name="eng_edu_major_subjects[]"></td>
                            <td><input type="text" name="eng_edu_percent[]"></td>
                            <td><input type="text" name="eng_edu_cgpa[]"></td>
                            <td><input type="file" name="eng_edu_certificate[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="eng_edu_exam_passed[]" value="PUC"></td>
                            <td><input type="text" name="eng_edu_board_uni[]"></td>
                            <td><input type="text" name="eng_edu_duration[]"></td>
                            <td><input type="text" name="eng_edu_year_passing[]"></td>
                            <td><input type="text" name="eng_edu_major_subjects[]"></td>
                            <td><input type="text" name="eng_edu_percent[]"></td>
                            <td><input type="text" name="eng_edu_cgpa[]"></td>
                            <td><input type="file" name="eng_edu_certificate[]"></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="eng_degree_type[]">
                                    <option value="">Degree</option>
                                    <option value="BE/BTech-Mining">BE/BTech-Mining</option>
                                    <option value="BE/BTech-Civil">BE/BTech-Civil</option>
                                    <option value="BE/BTech Integrated-Mining">BE/BTech Integrated-Mining</option>
                                    <option value="BE/BTech Integrated-Civil">BE/BTech Integrated-Civil</option>
                                    <option value="Others">Others</option>
                                </select>
                            </td>
                            <td><input type="text" name="eng_edu_board_uni[]"></td>
                            <td><input type="text" name="eng_edu_duration[]"></td>
                            <td><input type="text" name="eng_edu_year_passing[]"></td>
                            <td><input type="text" name="eng_edu_major_subjects[]"></td>
                            <td><input type="text" name="eng_edu_percent[]"></td>
                            <td><input type="text" name="eng_edu_cgpa[]"></td>
                            <td><input type="file" name="eng_edu_certificate[]"></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="eng_post_graduate_type[]">
                                    <option value="">Post Graduate Degree</option>
                                    <option value="MTech">MTech</option>
                                    <option value="MS">MS</option>
                                    <option value="Others">Others</option>
                                </select>
                            </td>
                            <td><input type="text" name="eng_edu_board_uni[]"></td>
                            <td><input type="text" name="eng_edu_duration[]"></td>
                            <td><input type="text" name="eng_edu_year_passing[]"></td>
                            <td><input type="text" name="eng_edu_major_subjects[]"></td>
                            <td><input type="text" name="eng_edu_percent[]"></td>
                            <td><input type="text" name="eng_edu_cgpa[]"></td>
                            <td><input type="file" name="eng_edu_certificate[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="eng_edu_exam_passed[]" value="PhD"></td>
                            <td><input type="text" name="eng_edu_board_uni[]"></td>
                            <td><input type="text" name="eng_edu_duration[]"></td>
                            <td><input type="text" name="eng_edu_year_passing[]"></td>
                            <td><input type="text" name="eng_edu_major_subjects[]"></td>
                            <td><input type="text" name="eng_edu_percent[]"></td>
                            <td><input type="text" name="eng_edu_cgpa[]"></td>
                            <td><input type="file" name="eng_edu_certificate[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="eng_edu_exam_passed[]" value="Others"></td>
                            <td><input type="text" name="eng_edu_board_uni[]"></td>
                            <td><input type="text" name="eng_edu_duration[]"></td>
                            <td><input type="text" name="eng_edu_year_passing[]"></td>
                            <td><input type="text" name="eng_edu_major_subjects[]"></td>
                            <td><input type="text" name="eng_edu_percent[]"></td>
                            <td><input type="text" name="eng_edu_cgpa[]"></td>
                            <td><input type="file" name="eng_edu_certificate[]"></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <h3>11. Employment details (in reverse chronological order)</h3>
            <span class="note">(Enclose certificate of experience in respect of minimum desirable
                qualification)</span>

            <table>
                <thead>
                    <tr>
                        <th>Name of Employer with Address</th>
                        <th>Designation of the post held</th>
                        <th>From (Date)</th>
                        <th>To (Date)</th>
                        <th>Period (Years & Months)</th>
                        <th>Gross Pay (per month)</th>
                        <th>Nature of Duties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="emp_employer[]" value="{{ old('emp_employer.0') }}"></td>
                        <td><input type="text" name="emp_designation[]" value="{{ old('emp_designation.0') }}">
                        </td>
                        <td><input type="text" name="emp_from_date[]" value="{{ old('emp_from_date.0') }}"></td>
                        <td><input type="text" name="emp_to_date[]" value="{{ old('emp_to_date.0') }}"></td>
                        <td><input type="text" name="emp_period[]" value="{{ old('emp_period.0') }}"></td>
                        <td><input type="text" name="emp_gross_pay[]" value="{{ old('emp_gross_pay.0') }}"></td>
                        <td><input type="text" name="emp_duties[]" value="{{ old('emp_duties.0') }}"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="emp_employer[]" value="{{ old('emp_employer.1') }}"></td>
                        <td><input type="text" name="emp_designation[]" value="{{ old('emp_designation.1') }}">
                        </td>
                        <td><input type="text" name="emp_from_date[]" value="{{ old('emp_from_date.1') }}"></td>
                        <td><input type="text" name="emp_to_date[]" value="{{ old('emp_to_date.1') }}"></td>
                        <td><input type="text" name="emp_period[]" value="{{ old('emp_period.1') }}"></td>
                        <td><input type="text" name="emp_gross_pay[]" value="{{ old('emp_gross_pay.1') }}"></td>
                        <td><input type="text" name="emp_duties[]" value="{{ old('emp_duties.1') }}"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="emp_employer[]" value="{{ old('emp_employer.2') }}"></td>
                        <td><input type="text" name="emp_designation[]" value="{{ old('emp_designation.2') }}">
                        </td>
                        <td><input type="text" name="emp_from_date[]" value="{{ old('emp_from_date.2') }}"></td>
                        <td><input type="text" name="emp_to_date[]" value="{{ old('emp_to_date.2') }}"></td>
                        <td><input type="text" name="emp_period[]" value="{{ old('emp_period.2') }}"></td>
                        <td><input type="text" name="emp_gross_pay[]" value="{{ old('emp_gross_pay.2') }}"></td>
                        <td><input type="text" name="emp_duties[]" value="{{ old('emp_duties.2') }}"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="emp_employer[]" value="{{ old('emp_employer.3') }}"></td>
                        <td><input type="text" name="emp_designation[]" value="{{ old('emp_designation.3') }}">
                        </td>
                        <td><input type="text" name="emp_from_date[]" value="{{ old('emp_from_date.3') }}"></td>
                        <td><input type="text" name="emp_to_date[]" value="{{ old('emp_to_date.3') }}"></td>
                        <td><input type="text" name="emp_period[]" value="{{ old('emp_period.3') }}"></td>
                        <td><input type="text" name="emp_gross_pay[]" value="{{ old('emp_gross_pay.3') }}"></td>
                        <td><input type="text" name="emp_duties[]" value="{{ old('emp_duties.3') }}"></td>
                    </tr>
                </tbody>
            </table>


            <div class="form-group">
                <label for="present_work_nature">12. Nature of present work/job (Write the correct option):</label>
                <div class="input-group">
                    <select id="present_work_nature" name="present_work_nature" data-parsley-required="true">
                        <option value="" selected>Select an option</option>
                        <option value="GOVERNMENT SERVANT"
                            {{ old('present_work_nature') == 'GOVERNMENT SERVANT' ? 'selected' : '' }}>GOVERNMENT
                            SERVANT</option>
                        <option value="PRIVATE EMPLOYEE"
                            {{ old('present_work_nature') == 'PRIVATE EMPLOYEE' ? 'selected' : '' }}>PRIVATE EMPLOYEE
                        </option>
                        <option value="CONTRACT WORKER"
                            {{ old('present_work_nature') == 'CONTRACT WORKER' ? 'selected' : '' }}>CONTRACT WORKER
                        </option>
                        <option value="OTHER" {{ old('present_work_nature') == 'OTHER' ? 'selected' : '' }}>OTHER
                            (SPECIFY)</option>
                    </select>
                    <input type="text" id="other_work_specify" name="other_work_specify"
                        placeholder="Specify if OTHER" value="{{ old('other_work_specify') }}"
                        data-parsley-requiredother="#present_work_nature">
                </div>
            </div>



            <div class="form-group">
                <label for="experience_details">13. Experience relevant to the area of specialisation as per
                    advertisement (mention in detail):</label>
                <textarea id="experience_details" name="experience_details" data-parsley-required="true" rows="5">{{ old('experience_details') }}</textarea>
            </div>


            <div class="form-group">
                <p>14. a. Are you a Government Servant ?:</p>
                <div class="input-group">
                    <input data-parsley-required="true" type="radio" id="govt_servant_yes" name="govt_servant"
                        value="1" {{ old('govt_servant') == '1' ? 'checked' : '' }}><label
                        for="govt_servant_yes">YES</label>
                    <input data-parsley-required="true" type="radio" id="govt_servant_no" name="govt_servant"
                        value="0" {{ old('govt_servant') == '0' ? 'checked' : '' }}><label
                        for="govt_servant_no">NO</label>
                </div>
            </div>

            <div id="govt_appointment_type" class="form-group">
                <p>b. If yes, then nature of appointment?:</p>
                <div class="input-group">
                    <input data-parsley-required="true" type="radio" id="temp" name="appointment_nature"
                        value="TEMPORARY" {{ old('appointment_nature') == 'TEMPORARY' ? 'checked' : '' }}><label
                        for="temp">TEMPORARY</label>
                    <input data-parsley-required="true" type="radio" id="perm" name="appointment_nature"
                        value="PERMANENT" {{ old('appointment_nature') == 'PERMANENT' ? 'checked' : '' }}><label
                        for="perm">PERMANENT</label>
                    <input data-parsley-required="true" type="radio" id="contract" name="appointment_nature"
                        value="CONTRACT" {{ old('appointment_nature') == 'CONTRACT' ? 'checked' : '' }}><label
                        for="contract">CONTRACT</label>
                </div>
            </div>

            <div class="form-group">
                <p>If you are a government employee, your application has to be routed through proper channel. The
                    sample copy of the Endorsement can be downloaded here: <a
                        href="http://googleusercontent.com/gdg/nirm_form_example/Sample-Endorsement.pdf"
                        download>Sample Endorsement Form (PDF)</a></p>
                <label for="endorsement_upload">Attach the Endorsement Duly filled and Signed Here : (Please Upload the
                    Document here)</label>
                <input type="file" id="endorsement_upload" name="endorsement_upload"
                    data-parsley-required="true">

                <p> OR </p>
                <div class="input-group">
                    <input type="checkbox" id="endorsement_agreement" name="endorsement_agreement" value="1"
                        data-parsley-required="true">
                    <label for="endorsement_agreement">I agree to submit the duly filled and signed endorsement letter
                        from my employer before the interview if shortlisted and called for the interview.</label>
                </div>
            </div>


            <div class="form-group">
                <p>15. Have you been outside India? If YES, please provide details below:</p>
                <div class="input-group">
                    <input data-parsley-required="true" type="radio" id="outside_india_yes" name="outside_india"
                        value="1" {{ old('outside_india') == '1' ? 'checked' : '' }}><label
                        for="outside_india_yes">YES</label>
                    <input data-parsley-required="true" type="radio" id="outside_india_no" name="outside_india"
                        value="0" {{ old('outside_india') == '0' ? 'checked' : '' }}><label
                        for="outside_india_no">NO</label>
                </div>
            </div>

            <div id="country_visit_section">
                <table>
                    <thead>
                        <tr>
                            <th>Country visited</th>
                            <th>Period of visit</th>
                            <th>Purpose of visit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="country_visited[]" placeholder="Country"
                                    value="{{ old('country_visited.0') }}"></td>
                            <td><input type="text" name="period_visit[]" placeholder="Period"
                                    value="{{ old('period_visit.0') }}"></td>
                            <td><input type="text" name="purpose_visit[]" placeholder="Purpose"
                                    value="{{ old('purpose_visit.0') }}"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="country_visited[]" placeholder="Country"
                                    value="{{ old('country_visited.1') }}"></td>
                            <td><input type="text" name="period_visit[]" placeholder="Period"
                                    value="{{ old('period_visit.1') }}"></td>
                            <td><input type="text" name="purpose_visit[]" placeholder="Purpose"
                                    value="{{ old('purpose_visit.1') }}"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="country_visited[]" placeholder="Country"
                                    value="{{ old('country_visited.2') }}"></td>
                            <td><input type="text" name="period_visit[]" placeholder="Period"
                                    value="{{ old('period_visit.2') }}"></td>
                            <td><input type="text" name="purpose_visit[]" placeholder="Purpose"
                                    value="{{ old('purpose_visit.2') }}"></td>
                        </tr>
                    </tbody>
                </table>
            </div>



            <div class="form-group">
                <h3>16. Details of Publications (Enter the Numbers)</h3>
                <div class="form-row">
                    <label for="pub_international_journals_num">International Journals:</label>
                    <input type="number" id="pub_international_journals_num" name="pub_international_journals_num"
                        value="{{ old('pub_international_journals_num') }}">
                </div>
                <div class="form-row">
                    <label for="pub_national_journals_num">National Journals:</label>
                    <input type="number" id="pub_national_journals_num" name="pub_national_journals_num"
                        value="{{ old('pub_national_journals_num') }}">
                </div>
                <div class="form-row">
                    <label for="pub_international_conferences_num">International Conferences:</label>
                    <input type="number" id="pub_international_conferences_num"
                        name="pub_international_conferences_num"
                        value="{{ old('pub_international_conferences_num') }}">
                </div>
                <div class="form-row">
                    <label for="pub_national_conferences_num">National Conferences:</label>
                    <input type="number" id="pub_national_conferences_num" name="pub_national_conferences_num"
                        value="{{ old('pub_national_conferences_num') }}">
                </div>
                <div class="form-row">
                    <label for="pub_other_publications_num">Other Publications:</label>
                    <input type="number" id="pub_other_publications_num" name="pub_other_publications_num"
                        value="{{ old('pub_other_publications_num') }}">
                </div>
            </div>

            <div class="form-group">
                <h3>List of last five Significant Publications</h3>
                <table>
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Details of Publication</th>
                            <th>Upload here</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01</td>
                            <td>
                                <textarea name="sig_pub_detail_1" rows="3">{{ old('sig_pub_detail_1') }}</textarea>
                            </td>
                            <td><input type="file" name="sig_pub_upload_1"></td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>
                                <textarea name="sig_pub_detail_2" rows="3">{{ old('sig_pub_detail_2') }}</textarea>
                            </td>
                            <td><input type="file" name="sig_pub_upload_2"></td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>
                                <textarea name="sig_pub_detail_3" rows="3">{{ old('sig_pub_detail_3') }}</textarea>
                            </td>
                            <td><input type="file" name="sig_pub_upload_3"></td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>
                                <textarea name="sig_pub_detail_4" rows="3">{{ old('sig_pub_detail_4') }}</textarea>
                            </td>
                            <td><input type="file" name="sig_pub_upload_4"></td>
                        </tr>
                        <tr>
                            <td>05</td>
                            <td>
                                <textarea name="sig_pub_detail_5" rows="3">{{ old('sig_pub_detail_5') }}</textarea>
                            </td>
                            <td><input type="file" name="sig_pub_upload_5"></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="form-group">
                <p>17. (a) Have you ever been suspended or dismissed from past service:</p>
                <div class="input-group">
                    <input type="radio" id="suspended_yes" name="suspended" value="1"
                        data-parsley-required="true" {{ old('suspended') == '1' ? 'checked' : '' }}><label
                        for="suspended_yes">YES</label>
                    <input type="radio" id="suspended_no" name="suspended" value="0"
                        data-parsley-required="true" {{ old('suspended') == '0' ? 'checked' : '' }}><label
                        for="suspended_no">NO</label>
                </div>
            </div>

            <div class="form-group">
                <p>(b) Have you ever been arrested/ prosecuted (while in service or otherwise):</p>
                <div class="input-group">
                    <input type="radio" id="arrested_yes" name="arrested" value="1"
                        data-parsley-required="true" {{ old('arrested') == '1' ? 'checked' : '' }}><label
                        for="arrested_yes">YES</label>
                    <input type="radio" id="arrested_no" name="arrested" value="0"
                        data-parsley-required="true" {{ old('arrested') == '0' ? 'checked' : '' }}><label
                        for="arrested_no">NO</label>
                </div>
            </div>



            <div class="form-group">
                <p>18. Name and address of two Referees for verifying your credentials:</p>
                <textarea name="referee1" rows="3" placeholder="Referee 1 details" data-parsley-required="true">{{ old('referee1') }}</textarea>
                <input type="tel" name="referee1_phone" placeholder="Phone No. of Referee 1"
                    data-parsley-required="true" data-parsley-type="number" value="{{ old('referee1_phone') }}">
                <input type="email" name="referee1_email" placeholder="Email Id of Referee 1"
                    data-parsley-required="true" value="{{ old('referee1_email') }}">
                <textarea name="referee2" rows="3" placeholder="Referee 2 details" data-parsley-required="true">{{ old('referee2') }}</textarea>
                <input type="tel" name="referee2_phone" placeholder="Phone No. of Referee 2"
                    data-parsley-required="true" data-parsley-type="number" value="{{ old('referee2_phone') }}">
                <input type="email" name="referee2_email" placeholder="Email Id of Referee 2"
                    data-parsley-required="true" value="{{ old('referee2_email') }}">
            </div>



            <div class="form-group">
                <p>19. a. Are you willing to accept the minimum initial pay offered?:</p>
                <div class="input-group">
                    <input type="radio" data-parsley-required="true" id="accept_pay_yes" name="accept_minimum_pay"
                        value="1" {{ old('accept_minimum_pay') == '1' ? 'checked' : '' }}><label
                        for="accept_pay_yes">YES</label>
                    <input type="radio" data-parsley-required="true" id="accept_pay_no" name="accept_minimum_pay"
                        value="0" {{ old('accept_minimum_pay') == '0' ? 'checked' : '' }}><label
                        for="accept_pay_no">NO</label>
                </div>
            </div>

            <div id="lowest_pay_expected" class="form-group">
                <label for="expected_pay">b. If NO, then the lowest initial monthly basic pay expected:</label>
                <input type="text" id="expected_pay" name="expected_pay" value="{{ old('expected_pay') }}"
                    data-parsley-required="true">
            </div>

            <div class="form-group">
                <label for="joining_time">c. Minimum joining time required, if selected for the post:</label>
                <input type="text" id="joining_time" name="joining_time" value="{{ old('joining_time') }}"
                    data-parsley-required="true">
                <span class="note">(Any request for extension of joining time will not normally be considered)</span>
            </div>

            <div class="declaration">
                <p class="declaration-text">I hereby declare that the information furnished in this form is true to the
                    best of my knowledge and belief.</p>
                <p class="declaration-text">If, at any stage, if they are found misleading or untrue, my candidature or
                    appointment to the post may be rejected/ cancelled.</p>

                <div class="declaration-place">
                    <label for="place_declaration">Place:</label>
                    <input type="text" id="place_declaration" name="place_declaration"
                        value="{{ old('place_declaration') }}" data-parsley-required="true">
                </div>
            </div>

            <div class="qr-code-section">
                <h3>Payment Information</h3>
                <img src="https://goqr.me/qr/qr-code-with-text.png" alt="Sample QR Code for Payment">
                <p>Scan this QR code to make the application payment.</p>
                <div class="form-group">
                    <label for="payment_receipt_upload">Upload Payment Receipt/UPI Receipt:</label>
                    <input type="file" id="payment_receipt_upload" name="payment_receipt_upload"
                        data-parsley-required="true">
                </div>
                <p class="note">Please ensure to verify the payment details before completing the transaction.</p>
            </div>

            <div class="form-group">
                <label for="application_fee_details"> Details of the application fee paid (UPI Transaction ID
                    etc):</label>
                <input type="text" id="application_fee_details" name="application_fee_details"
                    value="{{ old('application_fee_details') }}" data-parsley-required="true">
            </div>



            <div class="submit-button-container">
                <input type="submit" value="Submit Application">
            </div>

        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>
    <script>
        window.Parsley.addValidator('fileextension', {
            validateString: function(value, requirement) {
                console.log(value);
                var ext = value.split('.').pop().toLowerCase();
                return requirement.split(',').indexOf(ext) !== -1;
            },
            messages: {
                en: 'Invalid file extension.'
            }
        });
        $(function() {
            validateFields($('#present_work_nature').val(), '#other_work_specify', 'OTHER');
            validateFields($('#category').val(), '#other_category_specify', 'OTHER');
            //citizen_india
            validateFields($('input[name="citizen_india"]:checked').val(), '#belong_state', '1');
            $('#present_work_nature').on('change', function() {
                validateFields($(this).val(), '#other_work_specify', 'OTHER');
            });
            $('#category').on('change', function() {
                validateFields($(this).val(), '#other_category_specify', 'OTHER');
            });
            $('input[name="citizen_india"]').on('change', function() {
                validateFields($(this).val(), '#belong_state', '1');
            });
            function validateFields(value, target, text) {
                if (value === text) {
                    $(target).attr('required', true);
                } else {
                    $(target).attr('required', false);
                }
            }
        });
    </script>
    <script>
        function toggleEducationTables() {
            const scienceRadio = document.getElementById('degree_science');
            const engineeringRadio = document.getElementById('degree_engineering');
            const scienceTable = document.getElementById('scienceTable');
            const engineeringTable = document.getElementById('engineeringTable');

            if (scienceRadio.checked) {
                scienceTable.style.display = 'block';
                engineeringTable.style.display = 'none';
            } else if (engineeringRadio.checked) {
                scienceTable.style.display = 'none';
                engineeringTable.style.display = 'block';
            } else {
                scienceTable.style.display = 'none';
                engineeringTable.style.display = 'none';
            }
        }
    </script>

</body>

</html>
