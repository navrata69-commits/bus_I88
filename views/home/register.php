<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Register - Bus</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ff0000, #ffffff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .card-header {
      background-color: #ff0000;
      color: #fff;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }
    .btn-primary {
      background-color: #ff0000;
      border: none;
      border-radius: 0.5rem;
    }
    .btn-primary:hover {
      background-color: #e60000;
      transform: translateY(-1px);
    }
  </style>
</head>
<body>
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card shadow-lg border-0 mt-5">
          <div class="card-header text-center py-3">
            <h3 class="my-2">Register</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="/register">
              
              <div class="form-floating mb-3">
                <input class="form-control" name="name" id="inputName" type="text" placeholder="Your Name" required>
                <label for="inputName">Full Name</label>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" required>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control" name="phone_number" id="inputPhone" type="text" placeholder="08123456789">
                <label for="inputPhone">Phone Number</label>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control" name="confirm_password" id="inputConfirm" type="password" placeholder="Confirm Password" required>
                <label for="inputConfirm">Confirm Password</label>
              </div>

              <?php if(isset($error)): ?>
                <div class="text-danger mb-3">
                  <?php echo htmlspecialchars($error); ?>
                </div>
              <?php endif; ?>

              <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <button class="btn btn-primary px-4" type="submit">Register</button>
              </div>
            </form>
          </div>
          <div class="card-footer text-center py-3 bg-light">
            <div class="small">
              <a href="/login">Already have an account? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
