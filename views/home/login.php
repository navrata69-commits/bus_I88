<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Bus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

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
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      }

      .card-header {
        background-color: #ff0000;
        color: #fff;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
      }

      .form-floating label {
        color: #666;
      }

      .form-control {
        border-radius: 0.5rem;
        border: 1px solid #ccc;
        transition: border-color 0.3s;
      }

      .form-control:focus {
        border-color: #004a99;
        box-shadow: 0 0 5px rgba(0, 74, 153, 0.3);
      }

      .btn-primary {
        background-color: #ff0000;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
      }

      .btn-primary:hover {
        background-color: #ff0000;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 95, 204, 0.3);
      }

      a.small {
        color: #004a99;
        text-decoration: none;
        font-weight: 500;
      }

      a.small:hover {
        text-decoration: underline;
      }

      footer {
        background: transparent;
        color: #fff;
      }

      .card-footer a {
        color: #004a99;
        text-decoration: none;
        font-weight: 500;
      }

      .card-footer a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <main class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card shadow-lg border-0 mt-5">
            <div class="card-header text-center py-3">
              <h3 class="font-weight-light my-2">Login</h3>
            </div>
             <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <div class="card-body">
              <form method="POST" action="/login">

                <div class="form-floating mb-3">
                  <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" required />
                  <label for="inputEmail">Email address</label>
                </div>
                <?php if (isset($errors['email'])): ?>
                    <div class="error-message">
                        <?php foreach ($errors['email'] as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="form-floating mb-3">
                  <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" required />
                  <label for="inputPassword">Password</label>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <div class="error-message">
                        <?php foreach ($errors['password'] as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                  <button class="btn btn-primary px-4" type="submit">Login</button>
                </div>
              </form>
               <?php if(isset($error)) :?>
                  <p><?php echo htmlspecialchars($error); ?></p>
               <?php endif; ?>
            </div>
            <div class="card-footer text-center py-3 bg-light">
              <div class="small">
                <a href="/register">Need an account? Sign up!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>
