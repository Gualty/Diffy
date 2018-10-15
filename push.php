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

switch ($gds) {
    case "Mon":
        $messaggio = "*Lunedì*\n\n*E' arrivato il momento di portare fuori:*\n\n🍗 *Organico*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
        break;
    case "Tue":
        $messaggio = "*Martedì*\n\n*E' arrivato il momento di portare fuori:*\n\n📦 *Carta, Cartone e Cartoncino*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
        break;
    case "Wed":
        $messaggio = "*Mercoledì*\n\n*E' arrivato il momento di portare fuori:*\n\n🍗 *Organico*\n\n🚼 *Pannolini e pannoloni*\n_Vanno esposti in sacchetti separati riconoscibili posti accanto il rifiuto differenziato giornaliero._\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
        break;
    case "Thu":
        $messaggio = "*Giovedì*\n\n*E' arrivato il momento di portare fuori:*\n\n🎈🥫 *Plastica e Metalli*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
        break;
    case "Fri":
        $messaggio = "*Venerdì*\n\n*E' arrivato il momento di portare fuori:*\n\n🍗 *Organico*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
        break;
    case "Sat":
        $messaggio = "*Sabato*\n\n*E' arrivato il momento di portare fuori:*\n\n🍷 *Vetro*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
        break;
    case "Sun":
        $messaggio = "*Domenica*\n\n*E' arrivato il momento di portare fuori:*\n\n💡 *Indifferenziato*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
        break;
    default:
        break;
}

//Fine Calcolo giorno della settimana e Messaggio

//Connessione DB
$servername = "localhost";
$username = "USERNAME";
$password = "";
$dbname = "differenziatabot";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//N.B. RIPORTARE I DATI DB ANCHE NEL FILE index.php
//Fine Connessione DB

//INVIO NOTIFICHE A CHI LO HA RICHIESTO
$sql = "SELECT id_utente FROM differenziatabot WHERE attivo='1'"; //SOLO A CHI HA RICHIESTO LA NOTIFICA VIENE INVIATA
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $chat_id =$row["id_utente"];
        $reply = $messaggio;
        //Template Messaggio
        $option = [['📦 Carta, Cartone e Cartoncino','🎈🥫 Plastica e Metalli'], ['🍷 Vetro', '🍗  Organico','💡 Indifferenziato'],['🗑️ Altri rifiuti'],['Menu Principale']];
        // Create a permanent custom keyboard
        $keyb = $telegram->buildKeyBoard($option, $onetime = false);
        $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $reply,'parse_mode' => 'markdown'];


        $telegram->sendMessage($content);
        //Fine Template Messaggio
    }
} else {
    echo "0 results";
}
//FINE INVIO NOTIFICHE A CHI LO HA RICHIESTO
?>
