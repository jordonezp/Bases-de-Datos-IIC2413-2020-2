<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>
<?php include('../templates/header.html'); ?>
<?php require("../config/conection.php"); ?>

<div class="container is-max-desktop">
    <form align="center" action="consultas_api/recieved_messages.php" method="get">
        <input type="hidden" name="usuario_id" value=<?php echo $usuario_id ?> />
        <input class="button is-link" type="submit" value="Mensajes Recibidos">
    </form>
</div>
<div class="container is-max-desktop">
    <form align="center" action="consultas_api/sent_messages.php" method="get">
        <input type="hidden" name="usuario_id" value=<?php echo $usuario_id ?> />
        <input class="button is-link" type="submit" value="Mensajes Enviados">
    </form>
</div>
<div class="container is-max-desktop">
    <form align="center" action="consultas_api/send_message.php" method="get">
        <input type="hidden" name="sender" value=<?php echo $usuario_id ?> />
        <input class="button is-link" type="submit" value="Enviar Mensaje">
    </form>
</div>
<div class="container is-max-desktop">
    <form align="center" action="consultas_api/textsearch_messages.php" method="get">
        <input class="button is-link" type="submit" value="Buscar Mensajes">
    </form>
</div>
<div class="container is-max-desktop">
    <form align="center" action="consultas_api/mapa.php" method="get">
        <input class="button is-link" type="submit" value="Ver Mapa">
    </form>
</div>
