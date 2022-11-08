<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>notificación HDV</title>
    <style>
        a:hover {
            color: rgb(40, 4, 124);
            background: #42aaf4;
        }
        .subrayado{
            background-color: #fdff93;
        }
    </style>
</head>
    <body>
        <div>
            <p class="subrayado">
                Codigo de radicado #  {!! $cod !!}
            </p>
        </div>
        <div class="row">
            <div class="col-md-8" style="float: none; margin:auto;">
                <p class="subrayado">Para consultar el estado de No Conformidad, haga click <a href="{{asset('/NConformes/lista')}}"><b>AQUI</b></a></p>

            </div>
        </div>
        <div
            style="margin: 0 auto; background: #d4e3e7; color: rgb(0, 0, 0); width: 800px; padding: 20px; box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.377); border-radius: 20px;">
            <div style="background: #a0c6d9; margin: -20px; padding: 20px; border-radius: 20px 20px 0px 0px;">
                <h1 style="font-size: 18px" align="center">HOSPITAL DEPARTAMENTAL DE VILLAVICENCIO</h1>
            </div>
            <div style="background: #bee6ff; margin: -20px; padding: 20px; font-size: 15px">
                <h3 class="title-product">Información No Conforme.</h3>
                <br>
                <br>
                <h4 class="title-product">Información del reportante.</h4>
                <br>
                <p><b>Fecha de reporte: </b>{!! $fReporte !!} </p>
                <p><b>Reportado por: </b>{!! $reportado !!} </p>
                <p><b>proceso: </b>{!! $proceso !!} </p>
                <p><b>Coordinador: </b>{!! $reportante !!} </p>
                <br>
                <br>
                <h4 class="title-product">Información de no conformidad.</h4>
                <br>
                <p><b>proceso: </b>{!! $nCproceso !!} </p>
                <p><b>Area de servicio: </b>{!! $nCdescripcion !!}</p>
                <p><b>Acciones realizadas y fecha de realización: </b>{!! $nCacciones !!}</p>
                <br>
                <br>
                <h4 class="title-product">Información adicional.</h4>
                <br>
                <p><b>¿Requiere iniciar Acción Correctiva y/o Preventiva?: </b>{!! $accion !!}</p>
                <br>
                @if ()

                @endif
                <p><b>Archivos adjuntos: </b></p>



            </div>
            <div
                style="background: #a0c6d9;
        margin: -20px;
        padding: 20px;
        border-radius: 00px 00px 20px 20px;
        display: flex;
        justify-content: space-between;
        font-size: 15px">
                <p><b>Mensaje: </b><span>{!! $mensaje !!}</span></p>
            </div>
        </div>
    </body>

</html>
