<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pulizia dei dati
    $nome = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $oggetto = strip_tags(trim($_POST["subject"]));
    $messaggio = trim($_POST["message"]);

    // Controllo campi obbligatori
    if (empty($nome) || empty($email) || empty($oggetto) || empty($messaggio) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Per favore, compila correttamente tutti i campi.";
        exit;
    }

    // Email destinatario
    $to = "supporto@stopalbullismo.org";

    // Oggetto email
    $email_subject = "Nuovo messaggio dal form di contatto: $oggetto";

    // Corpo email
    $email_body = "Hai ricevuto un nuovo messaggio dal sito StopAlBullismo.org.\n\n".
                  "Nome: $nome\n".
                  "Email: $email\n".
                  "Oggetto: $oggetto\n".
                  "Messaggio:\n$messaggio\n";

    // Intestazioni email
    $headers = "From: $nome <$email>";

    // Invio email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Grazie per averci contattato, $nome. Ti risponderemo il prima possibile.";
    } else {
        echo "Si è verificato un errore, il messaggio non è stato inviato.";
    }
} else {
    echo "Richiesta non valida.";
}
?>
