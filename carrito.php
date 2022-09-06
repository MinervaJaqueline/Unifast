<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers">
        <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="./bootstrap/js/bootstrap.js"></script>
        <title> Unifast </title>
    </head>
   
    <body style="font-family: 'Roboto';">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #EA920F; font-weight: bold; color: #FFFFFF;">
            <a class="navbar-brand" href="./index.html"><img src="./src/img/Logo1.png" width="200px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto" style="padding: 0 2rem;">
                    <li class="nav-item" style="padding: 0 4rem;">
                        <a class="nav-link" href="./alimentos.php">ALIMENTOS <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item" style="padding: 0 4rem;">
                        <a class="nav-link" href="./bebidas.php">BEBIDAS</a>
                    </li>
                    <li class="nav-item" style="padding: 0 4rem;">
                        <a class="nav-link" href="./botanas.php">BOTANA</a>
                    </li>
                </ul>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" aria-label="Buscar" style="border-radius: 20px;">
                    <button class="btn my-2 my-sm-0" type="submit"><img src="./src/img/search.png" style="width: 1rem; margin-left: -6rem;"></button>
                </form>
                <div style="padding: 0 2rem;">
                    <a href="./iniciar_sesion.html" style="padding: 0 8px;"><img src="./src/img/user.png" width="30px"></a>
                    <a href="./carrito.php"><img src="./src/img/shopping-cart.png" width="30px"></a>
                </div>
            </div>
        </nav>
        <?php

        include ("conecta.phtml");
    
        $con = conecta();
        $consulta ="select Nom_producto, Precio from rproducto;";
        $resultado= $con->query($consulta);
        $filas = $resultado->num_rows;
        ?>


        <div style="height: 38rem;">
            <div class="card-deck" style="margin: 6rem 10rem 2rem 31rem; width: 30rem; height: 26rem;">
                <div class="card shadow-lg" style="border-radius: 15px; border: none;">
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 1rem; text-align: center; font-family: 'Bangers'; font-size: 60px;">CARRITO</h5>
                        <div class="row" style="margin-left: 3rem;">
                            <table style="width: 20rem; height: 7rem;">
                                <tr style="font-family: 'Roboto'; font-size: 15px; border-bottom: 1px solid #707070;">
                                    <th>CANTIDAD</th>
                                    <th>PRODUCTO</th>
                                    <th>SUBTOTAL</th>
                                </tr>
                                <?php
                                for($x=0; $x<$filas; $x++)
                                {
                                    $dato = $resultado->fetch_object();
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"> </td>
                                        <td> <?php echo $dato->Nom_producto; ?></td>
                                        <td style="padding-left: 1rem;">$ <?php echo $dato->Precio;?></td>
                                    </tr>
                                    
                                    
                                    <?php
                                    }
                                    ?>
                                
                            </table>
                        </div>
                        <div style="margin-top: 6rem; text-align: center;">
                            <div id="paypal-button-container"></div>
                            <!-- Sample PayPal credentials (client-id) are included -->
                            <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD&intent=capture&enable-funding=venmo"></script>
                            <script>
                                const paypalButtonsComponent = paypal.Buttons({
                                // optional styling for buttons
                                // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
                                style: {
                                    color: "gold",
                                    shape: "rect",
                                    layout: "vertical"
                                },

                                // set up the transaction
                                createOrder: (data, actions) => {
                                    // pass in any options from the v2 orders create call:
                                    // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                                    const createOrderPayload = {
                                        purchase_units: [
                                            {
                                                amount: {
                                                    value: "88.44"
                                                }
                                            }
                                        ]
                                    };

                                    return actions.order.create(createOrderPayload);
                                },

                                // finalize the transaction
                                onApprove: (data, actions) => {
                                    const captureOrderHandler = (details) => {
                                        const payerName = details.payer.name.given_name;
                                        console.log('Transaction completed');
                                    };

                                    return actions.order.capture().then(captureOrderHandler);
                                },

                                // handle unrecoverable errors
                                onError: (err) => {
                                    console.error('An error prevented the buyer from checking out with PayPal');
                                }
                            });

                            paypalButtonsComponent
                                .render("#paypal-button-container")
                                .catch((err) => {
                                    console.error('PayPal Buttons failed to render');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center text-white" style="background-color: #EA920F;">
            <div class="container pt-4">
                <section class="mb-4">
                    <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="www.facebook.com" role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-facebook-f"><img src="./src/img/facebook.png" style="width: 30px; margin-top: -20px;"></i>
                    </a>
                    <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="www.twitter.com" role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-twitter"><img src="./src/img/twitter-sign.png" style="width: 30px; margin-top: -20px;"></i>
                    </a>
                    <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="www.instagram.com" role="button" data-mdb-ripple-color="dark">
                        <i class="fab fa-instagram"><img src="./src/img/instagram.png" style="width: 30px; margin-top: -20px;"></i>
                    </a>
                </section>
            </div>
        </footer>
    
    </body>
</html>