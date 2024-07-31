<html>
<head>
    <meta charset="UTF-8">
    <title>New Submission</title>
</head>
<body>
        <img src="https://menow.b-cdn.net/logo.png" alt="Company Logo" style="width:150px;height:150px;"   data-auto-embed="attachment">

    <h1>New Contact Us Submission</h1>
    
    <p><strong>Name:</strong> {{ $submission->name }}</p>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Subject:</strong> {{ $submission->subject }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $submission->message }}</p>
</body>
</html>
