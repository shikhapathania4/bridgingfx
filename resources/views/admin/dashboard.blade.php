<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script></html>


        <style> 
        
            .sidebar {
                min-height: 100vh;
                background-color: #f8f9fa;
                padding: 20px;
            }
            .brand-logo {
                display: block;
                /* margin: 0 auto 30px; */
                width: 150px;
                height: 150px;
                }
            .sidebar a {
                display: block;
                padding: 10px;
                margin-bottom: 5px;
                text-decoration: none;
                color: #333;
                border-radius: 5px;
            }
            .sidebar a.active {
                background-color: #007bff;
                color: #fff;
            }
            .main-content {
                    width: 100%;

                margin-left: 24px;
                padding: 20px;
            }
        </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <img src="{{ asset('images/logo.png') }}" alt="Brand Logo" class="brand-logo">
            <br /><br />
            <a href="{{ route('admin.dashboard') }}" >Submission List</a><br />
            <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
        <div class="main-content">
            <h2 class="mb-4">Submission List</h2>
            <a href="{{ url('admin/submissions/export') }}" class="btn btn-success mb-3">Export to CSV</a>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($submissions as $submission)
                        <tr>
                            <td>{{ $submission->id }}</td>
                            <td>{{ $submission->name }}</td>
                            <td>{{ $submission->email }}</td>
                            <td>{{ $submission->subject }}</td>
                            <td>{{ $submission->message }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-id="{{ $submission->id }}" data-bs-toggle="modal" data-bs-target="#submissionModal">View</button>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#feedbackModal" data-id="{{ $submission->id }}" data-email="{{ $submission->email }}">Send Feedback</button>
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No submissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="submissionModal" tabindex="-1" aria-labelledby="submissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submissionModalLabel">Submission Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="submissionDetails">
                        <!-- Details will be injected here via AJAX -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Send Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="feedbackForm" action="{{ url('admin/submissions/feedback') }}" method="POST">
                        @csrf
                        <input type="hidden" name="submission_id" id="submission_id">
                        <input type="hidden" name="submission_email" id="submission_email">
                        <div class="mb-3">
                            <label for="feedbackMessage" class="form-label">Feedback Message</label>
                            <textarea class="form-control" id="feedbackMessage" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#feedbackModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var submissionId = button.data('id');
            var submissionEmail = button.data('email');

            var modal = $(this);
            modal.find('#submission_id').val(submissionId);
            modal.find('#submission_email').val(submissionEmail);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#submissionModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); 
                var id = button.data('id'); 

                $.ajax({
                    url: '/admin/submissions/view/' + id,
                    method: 'GET',
                    success: function(data) {
                        var details = `
                            <p><strong>ID:</strong> ${data.id}</p>
                            <p><strong>Name:</strong> ${data.name}</p>
                            <p><strong>Email:</strong> ${data.email}</p>
                            <p><strong>Subject:</strong> ${data.subject}</p>
                            <p><strong>Message:</strong> ${data.message}</p>
                        `;
                        $('#submissionDetails').html(details);
                    }
                });
            });
        });
    </script>

    
    </body>
    </html>