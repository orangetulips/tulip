<!DOCTYPE html>
<html>
  <head>
    <title>Tulip Farm</title>
    <style>
  .login-container {
    text-align: center;
  }

  .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: Arial, sans-serif;
  }

  .heading-container {
    text-align: center;
  }

  h1 {
    font-size: 70px;
    margin-left: 50px;
  }

  h2 {
    text-align: center;
  }
  
  input[type="submit"] {
    width: 100%;
    margin-bottom: 20px;
    margin-right: 100px;
    background-color: rgb(50, 51, 46);;
    padding: 10px 20px;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    display: inline-block;
  }

  input[type="submit"]:hover {
    background-color: darkgray;
  }

  .error-message {
    color: red;
    margin-top: 10px;
  }

  .login-joinus-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 30%;
  }
    body {
    background-image: url('dirt3.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
    background-position: center;
    color: white;
  }
        /* Optional: Adjust the height of the body element to fill the viewport */
    html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>
  </head>
  <body>
    <div class="container">
      <div class="heading-container">
        <h1>WELCOME TO TULIP'S FARM</h1>
      </div>
      <div class="login-joinus-container">
        <div class="login-container">
          <h2>Login</h2>
          <form method="POST" action="login.html">
            <input type="submit" value="Login">
          </form>
        </div>
        <div class="login-container">
          <h2>JoinUs</h2>
          <form method="POST" action="joinus.html">
            <input type="submit" value="JoinUs">
          </form>
        </div>
        <div class="error-message">
          <!-- Display error message here -->
        </div>
      </div>
    </div>
  </body>
</html>