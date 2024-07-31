<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .contact-form {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background: #f7f7f7;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .btn-block{
        background-color:#1079a7;
    }
    .contact-form h2 {
      margin-bottom: 30px;
    }
    .form-group label {
      font-weight: bold;
    }
    .brand-logo {
      display: block;
      margin: 0 auto 30px;
      width: 150px;
      height: 150px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="contact-form">
      <img src="{{ asset('images/logo.png') }}" alt="Brand Logo" class="brand-logo">
      <h2>Admin Login Panel</h2>
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Your Email">
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Your Password">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
