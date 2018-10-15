<?php
include 'Telegram.php';
// Imposta TOKEN Telegram
$bot_token = 'INSERIRETOKEN';
// Instances the class
$telegram = new Telegram($bot_token);
/* If you need to manually take some parameters
*  $result = $telegram->getData();
*  $text = $result["message"] ["text"];
*  $chat_id = $result["message"] ["chat"]["id"];
*/
// Take text and chat_id from the message
$text = $telegram->Text();
$chat_id = $telegram->ChatID();
$firstname = $telegram->FirstName();

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

//N.B. RIPORTARE I DATI DB ANCHE IN FONDO ALLA SEZIONE NOTIFICHE, NELLA SEZIONE /start qui sotto e nel file push.php
//Fine Connessione DB

// QUESTA PARTE APPARE SOLO ALLA PRIMA ATTIVAZIONE DEL BOT
if ($text == '/start'){
    $option = [['🗑️ Che rifiuti posso buttare stasera?'],['📅 Calendario','📄 Materiali'], ['ℹ️ Informazioni utili','📬 Notifiche'], ['NOMECITTA non è la tua città?'], ['Crediti']];
    // Create a permanent custom keyboard
    $keyb = $telegram->buildKeyBoard($option, $onetime = false);
    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb,'parse_mode' => 'markdown', 'text' => "♻️ Ciao ".$firstname.", sono *Diffy*!\n\nTi aiuterò con la raccolta differenziata di [NOMECITTA]!\n\n_Come posso aiutarti?_"];
    $telegram->sendMessage($content);

    //Memorizza chatID in DB
    //SOSTITUIRE differenziatabot CON IL NOME DEL DB SCELTO
    $sql = "INSERT INTO differenziatabot (id_utente,attivo)
    VALUES ($chat_id, '1')";
    //IN AUTOMATICO SARANNO ATTIVE LO NOTIFICHE PER TUTTI. CAMBIARE IL VALORE 1 in 0 QUI SOPRA PER RENDERE DISATTIVE DI DEFAULT
    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    //Fine Memorizza chatID in DB
}
//FINE /start

//MENU PRINCIPALE
if ($text == 'Menu Principale'){
    $option = [['🗑️ Che rifiuti posso buttare stasera?'],['📅 Calendario','📄 Materiali'], ['ℹ️ Informazioni utili','📬 Notifiche'], ['NOMECITTA non è la tua città?'], ['Crediti']];
    // Create a permanent custom keyboard
    $keyb = $telegram->buildKeyBoard($option, $onetime = false);
    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb,'parse_mode' => 'markdown', 'text' => "♻️ Ciao ".$firstname.", sono *Diffy*!\n\n_Come posso aiutarti oggi?_"];
    $telegram->sendMessage($content);
}
//FINE MENU PRINCIPALE

//CALENDARIO
if ($text == '📅 Calendario') {
  $option = [['Lunedì'], ['Martedì'], ['Mercoledì'], ['Giovedì'], ['Venerdì'], ['Sabato'], ['Domenica'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Seleziona il giorno della settimana"];
  $telegram->sendMessage($content);
}

//Giorni della settimana

//Se venissero apportate modifice, riportare le stesse anche sul file push.php
if ($text == 'Lunedì') {
  $option = [['💡 Indifferenziato'], ['📅 Calendario'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Lunedì*\n\n💡 *Indifferenziato*\n\n*Esposizione*\n_Domenica dalle ore 20:00 alle ore 22:30_"];
  $telegram->sendMessage($content);
}
if ($text == 'Martedì') {
  $option = [['🍗  Organico'], ['📅 Calendario'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Martedì*\n\n🍗 *Organico*\n\n*Esposizione*\n_Lunedì dalle ore 20:00 alle ore 22:30_"];
  $telegram->sendMessage($content);
}
if ($text == 'Mercoledì') {
  $option = [['📦 Carta, Cartone e Cartoncino'], ['📅 Calendario'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Mercoledì\n\n📦 *Carta, Cartone e Cartoncino*\n\n*Esposizione*\n_Martedì dalle ore 20:00 alle ore 22:30_"];
  $telegram->sendMessage($content);
}
if ($text == 'Giovedì') {
  $option = [['🍗  Organico'], ['📅 Calendario'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Giovedì*\n\n🍗 *Organico*\n\n🚼 *Pannolini e pannoloni*\n_Vanno esposti in sacchetti separati riconoscibili posti accanto il rifiuto differenziato giornaliero._\n\n*Esposizione*\n_Mercoledì dalle ore 20:00 alle ore 22:30_"];
  $telegram->sendMessage($content);
}
if ($text == 'Venerdì') {
  $option = [['🎈🥫 Plastica e Metalli'], ['📅 Calendario'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Venerdì*\n\n🎈🥫 *Plastica e Metalli*\n\n*Esposizione*\n_Giovedì dalle ore 20:00 alle ore 22:30_"];
  $telegram->sendMessage($content);
}
if ($text == 'Sabato') {
  $option = [['🍗  Organico'], ['📅 Calendario'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Sabato*\n\n🍗 *Organico*\n\n*Esposizione*\n_Venerdì dalle ore 20:00 alle ore 22:30_"];
  $telegram->sendMessage($content);
}
if ($text == 'Domenica') {
  $option = [['🍷 Vetro'], ['📅 Calendario'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Domenica*\n\n🍷 *Vetro*\n\n*Esposizione*\n_Sabato dalle ore 20:00 alle ore 22:30_"];
  $telegram->sendMessage($content);
}
//FINE CALENDARIO

//MATERIALI
if ($text == '📄 Materiali') {
  $option = [['📦 Carta, Cartone e Cartoncino','🎈🥫 Plastica e Metalli'], ['🍷 Vetro', '🍗  Organico','💡 Indifferenziato'],['🗑️ Altri rifiuti'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Seleziona il materiale"];
  $telegram->sendMessage($content);
}
if ($text == '📦 Carta, Cartone e Cartoncino') {
  //DESCRIZIONE
    $reply = "\xF0\x9F\x93\xA6 Carta, Cartone e Cartoncino";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
  //OK
    $reply = "\xE2\x9C\x85\nSacchetti di carta\nScatole\nImballaggi di cartone e cartoncino\nCarta da pacchi pulita\nCartoni per bevande e prodotti alimentari\nGiornali\nRiviste\nQuaderni";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
    //NO
    $reply = "\xE2\x9D\x8C\nCarta sporca\nFazzolettini e tovaglioli\nCartoni della pizza sporchi\nScontrini fiscali di carta termica\nCarta chimica per fax\nCarta oleata\nCarta plastificata";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}
if ($text == '🎈🥫 Plastica e Metalli') {
  //DESCRIZIONE
    $reply = "🎈🥫 Plastica e Metalli";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
  //OK
    $reply = "\xE2\x9C\x85\nBottiglie e flaconi di plastica\nBuste e pellicole in plastica\nVaschette e vasetti di yogurth in plastica\nPiatti e bicchieri in plastica\nBombolette spray (vuote)\nTubetti, lattine e vaschette in alluminio\nFogli sottili, scatolette, barattoli e altri contenitori metallici\nTappi a corona, chiusure e coperchi\nLatte per olio";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
    //NO
    $reply = "\xE2\x9D\x8C\nPosate di plastica\nGiocattoli\nPenne e pennarelli\nSpazzolini da denti\nOggetti in metallo\nPentole e posate\nFil di ferro";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}
if ($text == '🍷 Vetro') {
  //DESCRIZIONE
    $reply = "\xF0\x9F\x8D\xB7 Vetro";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
  //OK
    $reply = "\xE2\x9C\x85\nBottiglie\nVasetti";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
    //NO
    $reply = "\xE2\x9D\x8C\nSpecchi\nCeramica\nPorcellana\nLampadine\nNeon\nLastre di vetro";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}
if ($text == '💡 Indifferenziato') {
  //DESCRIZIONE
    $reply = "💡 Indifferenziato";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
  //OK
    $reply = "\xE2\x9C\x85\nPosate di plastica\nPannolini\nMusicassette e VHS\nCarta carbone\nCarta plastificata\nCocci di ceramica, porcellana\nTerracotta\nCristalli e lastre di vetro\nGomma";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
    //NO
    $reply = "\xE2\x9D\x8C\nTutti i materiali riciclabili\nPile e farmaci\nMateriale edile\nBatterie auto\nSfalci di potatura\nApparecchiature elettroniche\nMateriali tossici e pericolosi";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}
if ($text == '🍗  Organico') {
  //DESCRIZIONE
    $reply = "🍗  Organico";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
  //OK
    $reply = "\xE2\x9C\x85\nAvanzi di cucina cotti e crudi\nScarti di frutta e verdura\nResidui di pane\nGusci di uova e ossa\nFondi di caffè\nFiltri di tè\nSegatura e trucioli\nFazzoletti di carta unti\nAvanzi di carne, pesce, salumi\nCenere";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
    //PANNOLINI E pannoloni
    $reply = "🚼 Pannolini e pannoloni vanno esposti in sacchetti separati riconoscibili posti accanto il rifiuto differenziato giornaliero. Sarà effettuato un ritiro apposito ogni giovedì.";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
    //NO
    $reply = "\xE2\x9D\x8C\nPiatti e bicchieri di carta\nCarcasse di animali\nOlio di frittura\nPannolini ed assorbenti\nGrandi quantità di ossa e gusci di frutti di mare\nCibi ancora caldi";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}

if ($text == '🗑️ Altri rifiuti') {
  //DESCRIZIONE
    $reply = "🗑️ Altri rifiuti";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
  //OK
    $reply = "*PANNOLINI:* Nella stessa giornata di ritiro della frazione umido è possibile conferire in un *sacchetto separato pannolini e pannoloni* per utenze con bambini e anziani (*previo accordo con gli operatori*).\n\n*SFALCI:* Nelle giornate di raccolta della frazione umida sarà ammessa l'esposizione di un *massimo di 2 sacchi trasparenti da 50 lt* (peso massimo *10Kg per sacco*) di *scarti di prato*. Quantitativi superiori potranno essere conferiti presso il sito indicato dal comune, nelle stesse giornate di raccolta.\n\n*INGOMBRANTI:* Il ritiro a domicilio degli ingombranti è *gratuito*. Per usufruire di questo servizio chiamare il *Numero Verde XXXXXXXXXX* solo dai numeri fissi.\n*Lun/Ven* dalle *09:00* alle *13:00*.\n\n*PILE E FARMACI:* I rifiuti particolari, come le *pile esauste e i farmaci scaduti*, devono essere conferiti presso gli *appositi contenitori* localizzati in vari punti del paese.";
    $content = ['chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'markdown'];
    $telegram->sendMessage($content);
    //NO
    $reply = "\xE2\x9D\x8C\nSanitari\nMateriale edile\nMateriale ferroso\nMateriali tossici e pericolosi";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}
//FINE MATERIALI

//INFORMAZIONI UTILI
if ($text == 'ℹ️ Informazioni utili') {
    $reply = "*Suggerimenti forniti dal Comune:*\n\n☎️*NUMERO VERDE: XXXXXXXXXXX*\n\n\xF0\x9F\x93\xB1 *NUMERO DA CELL: XXXXXXXXXX*\n_Per informazioni, segnalazioni, suggerimenti,
reclami, ritiro gratuito ingombranti e apparecchiature elettriche ed elettroniche, servizio di raccolta differenziata porta a porta._\n\n📍 *CENTRI DI RACCOLTA*\n\n*Viale XXXXXX*\n_Zona XXXXXX_\n🗺️ [INSERIRE LINK GOOGLE MAPS]\n\n*Via XXXXXX*\n_Zona XXXXXXX_\n🗺️ [INSERIRE LINK GOOGLE MAPS]\n\n🕘 *ORARIO DI CONFERIMENTO*\n\n_Dal lunedì al sabato_\ndalle 9.00 alle 12.30 e dalle 14.00 alle 19.00\n\n_Domenica_\nDomenica dalle 9.00 alle 12.30";
    $content = ['chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'markdown'];
    $telegram->sendMessage($content);
}
//FINE INFORMAZIONI UTILI

//CREDITI
if ($text == 'Crediti') {
    $reply = "Questo Bot Telegram non è in alcun modo affiliato al Comune di XXXXXXXX o all'azienda preposta alla raccolta.\n\nE' un semplice strumento per il cittadino che trae informazioni dal sito istituzionale del comune: [INSERIRE LINK SITO COMUNE]";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}
//FINE CREDITI

//NOTIFICHE
if ($text == '📬 Notifiche') {
  $option = [['Si','No'], /*['No'],*/['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*NOTIFICHE*\n\nVuoi ricevere una notifica dal *Lunedì alla Domenica* per avvisarti di portare fuori i rifiuti?"];
  $telegram->sendMessage($content);
}
if ($text == 'Si') {
  $option = [['Notifiche'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Grazie per aver attivato le notifiche*\n\nPotrai cambiare idea in qualunque momento."];
  $telegram->sendMessage($content);

  //Notifiche in DB
  $sql = "UPDATE differenziatabot SET attivo = '1' WHERE id_utente = $chat_id";

  if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
  } else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
  //Fine Memorizza chatID in DB
}
if ($text == 'No') {
  $option = [['Notifiche'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Non riceverai notifiche*\n\nPotrai cambiare idea in qualunque momento."];
  $telegram->sendMessage($content);

  //Notifiche in DB
  $sql = "UPDATE differenziatabot SET attivo = '0' WHERE id_utente = $chat_id";

  if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
  } else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
  //Fine Memorizza chatID in DB
}
//FINE NOTIFICHE

//Che rifiuti posso buttare stasera?
if ($text == '🗑️ Che rifiuti posso buttare stasera?'){
    $option = [['📅 Calendario','📄 Materiali'],['ℹ️ Informazioni utili'],['Menu Principale']];

    //Calcolo giorno della settimana e Messaggio
    $gds=date(D);

    switch ($gds) {
        case "Mon":
            $messaggio = "*Lunedì*\n\n*Stasera puoi portare fuori:*\n\n🍗 *Organico*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
            break;
        case "Tue":
            $messaggio = "*Martedì*\n\n*Stasera puoi portare fuori:*\n\n📦 *Carta, Cartone e Cartoncino*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
            break;
        case "Wed":
            $messaggio = "*Mercoledì*\n\n*Stasera puoi portare fuori:*\n\n🍗 *Organico*\n\n🚼 *Pannolini e pannoloni*\n_Vanno esposti in sacchetti separati riconoscibili posti accanto il rifiuto differenziato giornaliero._\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
            break;
        case "Thu":
            $messaggio = "*Giovedì*\n\n*Stasera puoi portare fuori:*\n\n🎈🥫 *Plastica e Metalli*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
            break;
        case "Fri":
            $messaggio = "*Venerdì*\n\n*Stasera puoi portare fuori:*\n\n🍗 *Organico*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
            break;
        case "Sat":
            $messaggio = "*Sabato*\n\n*Stasera puoi portare fuori:*\n\n🍷 *Vetro*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
            break;
        case "Sun":
            $messaggio = "*Domenica*\n\n*Stasera puoi portare fuori:*\n\n💡 *Indifferenziato*\n\n*Esposizione*\n_Dalle ore 20:00 alle ore 22:30_";
            break;
        default:
            break;
    }

    //Fine Calcolo giorno della settimana e Messaggio

    // Create a permanent custom keyboard
    $keyb = $telegram->buildKeyBoard($option, $onetime = false);
    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb,'parse_mode' => 'markdown', 'text' => $messaggio];
    $telegram->sendMessage($content);
}
//Fine Che rifiuti posso buttare stasera?

//NOMECITTA non è la tua città?
if ($text == 'NOMECITTA non è la tua città?'){
    $option = [['🗑️ Che rifiuti posso buttare stasera?'],['📅 Calendario','📄 Materiali'], ['ℹ️ Informazioni utili','📬 Notifiche'], ['NOMECITTA non è la tua città?'], ['Crediti']];
    // Create a permanent custom keyboard
    $keyb = $telegram->buildKeyBoard($option, $onetime = false);
    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb,'parse_mode' => 'markdown', 'text' => "♻️ *".$firstname."*, XXXXXX non è la tua città?\n\nEcco i Bot Telegram delle altre città siciliane:\n\n🤖 *Aci Catena* http://bit.ly/DiffAciCatena\n🤖 *Adrano* http://bit.ly/DiffAdrano\n🤖 *Catania* http://bit.ly/DiffCatania\n🤖 *Gravina di Catania* http://bit.ly/DiffGravinaCT\n🤖 *San Giovanni la Punta* http://bit.ly/DiffSGLaPunta\n🤖 *San Gregorio di Catania* http://bit.ly/DiffSanGregorioCT\n🤖 *Viagrande* http://bit.ly/DiffViagrande\n\n_N.B. Non sono ancora così interattivi come_ *Diffy*, _ma ben presto lo diventeranno.\n\n\n\n_"];
    $telegram->sendMessage($content);
}
//Fine NOMECITTA non è la tua città?
?>
