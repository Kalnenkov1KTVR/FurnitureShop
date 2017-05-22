<?php

if (!isset($_GET['message'])) {// переменная отправки сообщения
    ?>

    <h1>Обратная связь</h1>
    <form action="views/send_contact.php?page=<?php echo $_GET['page']; ?>" method="post" id="myForm">
        <div class="form_settings">
            <p><span>Имя</span><input class="contact" type="text" id="name" name="name" value="" placeholder="..." autofocus required/></p>
            <p><span>E-mail</span><input class="contact" type="text" id="email" name="email" value="" placeholder="..." required/></p>
            <p><span>Текст сообщения</span><textarea class="contact textarea" rows="8" cols="50" id="mess" name="message" placeholder="..." required></textarea></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="contact_submitted" id="button" value="Отправить" /></p>
        </div>
    </form>

    <?php
}
// всё норм
elseif (isset($_GET['message']) && $_GET['message'] == 'send') {
    echo '<h3>Отправка сообщения.</h3>
    <p class="para">Сообщение отправлено.</p>';
    echo '<hr><p><a href="' . INDEX . '?page=' . $page . '">Назад</a></p>';
}
// ошибка
else {
    echo '<h3>Ошибка.</h3>
    <p class="para">Сообщение НЕ отправлено <br>' .
    $_GET['message'] . '</p>';
    echo '<hr><p><a href="' . INDEX . '?page=' . $page . '">Назад</a></p>';
}
?>



