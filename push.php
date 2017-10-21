<?php
//NOTIFICHE PUSH
//Per attivare le notifiche push, configura il presente modulo in base alle tue esigenze
//Importa il file database.sql nel tuo database
//Successivamente attiva sul tuo Server la funzione Cron Job e fai eseguire questa pagina all'orario in cui è previsto l'inizio dell'esposizione dei rifiuti in strada
include 'Telegram.php';
// Set the bot TOKEN
$bot_token = 'INSERIRETOKEN';
// Instances the class
$telegram = new Telegram($bot_token);
// Take text and chat_id from the message
$text = $telegram->Text();

//Calcolo giorno della settimana e Messaggio
$gds=date(D);

// Zone:
// 1: Zona A
// 2: Zona B
switch ($gds) {
    case "Mon":
        $messaggio1 = "*Lunedì*\n_Zona A_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x8D\x89 *Organico*\nEd eventuali panni o pannoloni in un sacchetto separato\n\nEsporre dalle ore 20:00 alle ore 24:00";
        $messaggio2 = "*Lunedì*\n_Zona B_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x93\xA6 *Carta e Cartone*\n\nEsporre dalle ore 20:00 alle ore 24:00";
        break;
    case "Tue":
        $messaggio1 = "*Martedì*\n_Zona A_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x93\xA6 *Carta e Cartone*\n\nEsporre dalle ore 20:00 alle ore 24:00";
        $messaggio2 = "*Martedì*\n_Zona B_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x8D\x89 *Organico*\nEd eventuali panni o pannoloni in un sacchetto separato\n\nEsporre dalle ore 20:00 alle ore 24:00";
        break;
    case "Wed":
        $messaggio1 = "*Mercoledì*\n_Zona A_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x8D\x89 *Organico*\nEd eventuali panni o pannoloni in un sacchetto separato\n\nEsporre dalle ore 20:00 alle ore 24:00";
        $messaggio2 = "*Mercoledì*\n_Zona B_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x8E\x88\xF0\x9F\x8D\xB7 *Plastica, Vetro e Lattine*\n\nEsporre dalle ore 20:00 alle ore 24:00";
        break;
    case "Thu":
        $messaggio1 = "*Giovedì*\n_Zona A_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x92\xA1 *Indifferenziato*\n\nEsporre dalle ore 20:00 alle ore 24:00";
        $messaggio2 = "*Giovedì*\n_Zona B_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x8D\x89 *Organico*\nEd eventuali panni o pannoloni in un sacchetto separato\n\nEsporre dalle ore 20:00 alle ore 24:00";
        break;
    case "Fri":
        $messaggio1 = "*Venerdì*\n_Zona A_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x8D\x89 *Organico*\nEd eventuali panni o pannoloni in un sacchetto separato\n\nEsporre dalle ore 20:00 alle ore 24:00";
        $messaggio2 = "*Venerdì*\n_Zona B_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x92\xA1 *Indifferenziato*\n\nEsporre dalle ore 20:00 alle ore 24:00";
        break;
    case "Sun":
        $messaggio1 = "*Domenica*\n_Zona A_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x8E\x88\xF0\x9F\x8D\xB7 *Plastica, Vetro e Lattine*\n\nEsporre dalle ore 20:00 alle ore 24:00";
        $messaggio2 = "*Domenica*\n_Zona B_\n\n*E' arrivato il momento di portare fuori:*\n\n\xF0\x9F\x8D\x89 *Organico*\nEd eventuali panni o pannoloni in un sacchetto separato\n\nEsporre dalle ore 20:00 alle ore 24:00";
        break;
    default:
        break;
}

//Fine Calcolo giorno della settimana e Messaggio

//Parametri e Connessione DB
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nomedatabase";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//Fine Connessione DB

// 1: Zona A
$sql = "SELECT id_utente FROM differenziatabot WHERE attivo='1' AND zona= '1'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $chat_id =$row["id_utente"];

        //Template Messaggio
        $reply = $messaggio1;
        $option = [['Carta e Cartone','Plastica'], ['Vetro e Lattine','Organico'], ['Indifferenziato','Ingombranti'],['Menu Principale']];
        // Create a permanent custom keyboard
        $keyb = $telegram->buildKeyBoard($option, $onetime = false);
        $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $reply,'parse_mode' => 'markdown'];

        $telegram->sendMessage($content);
        //Fine Template Messaggio
    }
} else {
    echo "0 results Zona A";
}

// 2: Zona B
$sql = "SELECT id_utente FROM differenziatabot WHERE attivo='1' AND zona= '2'";
$result1 = mysqli_query($conn, $sql);

if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row1 = mysqli_fetch_assoc($result1)) {
        $chat_id =$row1["id_utente"];

        //Template Messaggio
        $reply = $messaggio2;
        $option = [['Carta e Cartone','Plastica'], ['Vetro e Lattine','Organico'], ['Indifferenziato','Ingombranti'],['Menu Principale']];
        // Create a permanent custom keyboard
        $keyb = $telegram->buildKeyBoard($option, $onetime = false);
        $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $reply,'parse_mode' => 'markdown'];
        $telegram->sendMessage($content);
        //Fine Template Messaggio
    }
} else {
    echo "0 results Zona B";
}

?>
