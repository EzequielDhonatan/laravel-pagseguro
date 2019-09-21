<!DOCTYPE html>
<html lang="en">
<head>
    <title>PagSeguro LightBox</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

    <a class="btn btn-outline-success btn-buy" href="">Finalizar compra</a>

    {!! csrf_field()  !!}

    <div class="msg-return"></div>

    <div class="preloader" style="display: none;">Carregando...</div>

    <!-- PagSeguro -->
    <script src="{{ config('pagseguro.url_lightbox_sandbox') }}"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(function(){
            $('.btn-buy').click(function() {
                $.ajax({


                    url: "{{route('pagseguro.lightbox.code')}}",
                    method: "POST",
                    data: {_token: $('input[name=_token]').val()},
                    beforeSend: startPreloader()

                }).done(function(code) {

                    lightbox(code);

                }).fail(function() {

                    alert("Erro inesperado, tente novamente!");

                }).always(function() {

                    stopPreloader();

                });
                
                return false;
            });
        });
        
        function lightbox(code)
        {
            let isOpenLightbox = PagSeguroLightbox({

                code: code

            }, {

                success: function(transactionCode){
                    $('.msg-return').html("Pedido realizado com sucesso: "+transactionCode);
                },

                abort: function(){
                    alert("Compra Abortada!");
                }

            });
            
            if( !isOpenLightbox ) {
                location.href="{{config('pagseguro.url_redirect_after_request')}}"+code;
            }
        }
        
        function startPreloader()
        {
            $('.preloader').show();
        }
        
        function stopPreloader()
        {
            $('.preloader').hide();
        }
    </script>
</body>
</html>