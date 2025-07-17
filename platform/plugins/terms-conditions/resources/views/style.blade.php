<style type="text/css">
    /* Global Styles and Typography */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        color: #333333;
        line-height: 1.6;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 30px 50px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2, h3 {
        border-bottom: 2px solid #0056b3;
        padding-bottom: 10px;
        margin-top: 30px;
        margin-bottom: 20px;
        color: #333333;
        font-weight: bold;
    }

    h2 {
        font-size: 24px;
        text-align: center;
    }

    h3 {
        font-size: 18px;
        text-align: center;
    }

    h2.western, h3.western {
        font-family: "Liberation Serif", serif;
    }

    p {
        margin-bottom: 15px;
        font-size: 14px;
    }

    a:link {
        color: #000080;
        text-decoration: none;
    }

    a:visited {
        color: #800000;
    }

    a:hover {
        text-decoration: underline;
    }

    hr {
        border: 0;
        border-top: 1px solid #ccc;
        margin: 20px 0;
    }

    /* Header Specifics */
    .header-content {
        text-align: center;
        margin-bottom: 30px;
    }

    .institute-name {
        font-size: 20px;
        font-weight: bold;
        color: #003366;
        margin-bottom: 5px;
    }

    .institute-name.hindi {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .address-info {
        font-size: 12px;
        color: #666;
    }

    /* Form Layout and Inputs */
    form {
        padding: 20px 0;
    }

    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="number"],
    input[type="date"], /* Added date input type */
    textarea,
    select {
        width: 60%; /* Adjusted for flexibility within form-row, but main fields are 60% */
        padding: 8px 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
    }
    
    /* Specific input width for table cells */
    table input[type="text"],
    table select,
    table input[type="file"], /* Added file input type for tables */
    table textarea { /* Added textarea for tables */
        width: 100%; /* Make inputs fill table cells */
        padding: 5px;
        margin: 0;
        border: 1px solid #eee; /* Lighter border for table inputs */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }


    textarea {
        resize: vertical;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    .form-row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        gap: 10px; /* Space between label and input */
    }
    
    .form-row > p, .form-row > label {
        flex-shrink: 0; /* Prevent labels from shrinking */
        min-width: 250px; /* Ensure labels have enough space */
    }

    .form-row input[type="text"], .form-row select, .form-row input[type="date"] {
        flex-grow: 1; /* Allow input to take remaining space */
        width: auto; /* Override general 60% width for flex items */
    }


    /* Specific Elements */
    #Frame1 {
        float: right;
        width: 200px;
        height: 150px;
        border: 2px dashed #0056b3;
        padding: 10px;
        background: #e9f5ff;
        text-align: center;
        font-size: 12px;
        margin-left: 20px;
        margin-bottom: 20px;
    }

    #Frame1 input[type="file"] {
        display: block;
        margin: 10px auto;
        width: 100%;
    }

    #Frame1 p {
        color: #777777;
        margin: 0;
    }

    /* Tables (Educational & Employment) */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 13px;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px 12px;
        text-align: left;
    }

    table th {
        background-color: #f2f2f2;
        font-weight: bold;
        color: #333;
    }

    /* Declaration Section */
    .declaration {
        margin-top: 40px;
        padding-top: 15px;
        border-top: 1px solid #ccc;
    }

    .declaration-text {
        font-style: italic;
        margin-bottom: 15px;
    }

    .declaration-place {
        margin-top: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .declaration-place label {
        flex-shrink: 0;
    }

    .declaration-place input {
        flex-grow: 1;
        width: auto;
    }

    /* Utility Classes */
    .note {
        font-size: 11px;
        color: #555;
        margin-top: 5px;
        display: block;
    }

    .input-group {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap; /* Allow wrapping for small screens */
    }

    .input-group input[type="text"], .input-group select {
        flex-grow: 1;
        width: auto; /* Override main input width */
    }
    
    .contact-info p {
        margin: 5px 0;
    }

    /* QR Code Specific Styles */
    .qr-code-section {
        margin-top: 40px;
        padding: 20px;
        border: 1px dashed #0056b3;
        text-align: center;
        background-color: #e9f5ff;
        border-radius: 8px;
    }

    .qr-code-section img {
        max-width: 150px;
        height: auto;
        display: block;
        margin: 0 auto 15px auto;
    }

    .qr-code-section p {
        font-size: 14px;
        color: #333;
    }

    .qr-code-section .form-group {
        margin-top: 20px;
        margin-bottom: 0; /* Adjust spacing within this section */
        align-items: center; /* Center items within the form group */
    }

    .qr-code-section .form-group label {
        width: auto; /* Allow label to fit content */
        margin-right: 10px; /* Space between label and input */
    }

    .qr-code-section .form-group input[type="file"] {
        width: auto; /* Allow file input to fit content */
        max-width: 250px; /* Limit width to prevent overflow */
        margin-top: 5px;
    }

    /* Submit Button Styles */
    .submit-button-container {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #ccc;
    }

    .submit-button-container input[type="submit"] {
        background-color: #0056b3;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .submit-button-container input[type="submit"]:hover {
        background-color: #004080;
    }

    .alert {
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

</style>