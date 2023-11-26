

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../Assets/Styles/then.css">
    <link rel="stylesheet" href="../Assets/Styles/FAQ.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        

        function enablebtn() {
            document.getElementById("button1").disabled = false;
            
        }

        function registrar() {
            var formData = $('#registro').serialize();

            
            $.ajax({
                type:"POST",
                url:"../Controladores/ctrlProd.php?opc=6",
                data:formData,
                success:function(data,respuesta){
                    $('#testo').html(data);
                    alert(respuesta);
                },
            })
        }
    </script>
    <title>Login</title>
</head>
<body>
    <!--  header -->
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="./Indix.html"><h3 class="tituoloco">Camisetas el chido</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="../Index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../aboutus.html">Contactus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../FAQ.html">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./login1.php">Iniciar sesion</a>
            </li>
          </ul>
        </div>
      </nav>
       <!--  header -->
      <center>
      <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div id="testo"></div>
                <div class="panel-body">
                    <h5 class="text-center">
                        SIGN UP</h5>
                        <img src="https://cdn-icons-png.flaticon.com/512/16/16363.png" alt="">
                    <form class="form form-signup" id="registro" role="form" onsubmit="return false" >
                        <div class="registro1" id="registro1"></div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" name="txtusuario" id="txtusuario" placeholder="Username" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input type="text" class="form-control" name="txtemail" id="txtemail" placeholder="Email Address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" name="txtpass" id="txtpass" placeholder="Password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Ld42eooAAAAAIeW7ssBxH6z1SlMdBIhJxAc5Zo8" data-callback="enablebtn">

                        </div>
                    </div>
                </div>
                <!-- onclick="registrar()"  header -->
                
                <button disabled= "disabled" onclick="registrar()" id="button1"  type="submit" name="submit" class="btn btn-sm btn-primary btn-block">
                    SUBMIT</button> </form>
            </div>
        </div>
    </div>
      </center>

</body>
</html>
