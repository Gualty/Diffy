<?php
include 'Telegram.php';
// Imposta TOKEN Telegram
$bot_token = 'INSERIRETOKEN';

$telegram = new Telegram($bot_token);

$text = $telegram->Text();
$chat_id = $telegram->ChatID();

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

if (($text == '/start') || ($text == 'Menu Principale')){
    $option = [['Calendario'], ['Materiali'], ['Informazioni utili'], ['Notifiche'], ['Crediti']];

    $keyb = $telegram->buildKeyBoard($option, $onetime = false);
    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Seleziona una delle opzioni"];
    $telegram->sendMessage($content);

    //Memorizza chatID in DB all'avvio
    
    //Cambio il valore 0 in 1 se preferisci che a tutti i nuovi utenti siano attivate le notifiche in automatico
    $sql = "INSERT INTO differenziatabot (id_utente,attivo)
    VALUES ($chat_id, '0')";

    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    //Fine Memorizza chatID in DB
}

//Calendario
//Questo script predispone il supporto a 2 aree diverse della città. Ma è possibile modificarlo per creare più zone
if ($text == 'Calendario') {
  $option = [['Zona A'], ['Zona B'], ['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Seleziona la tua zona di residenza:*\nZona A\nZona B"];
  $telegram->sendMessage($content);
}
if ($text == 'Zona A') {
  $option = [['Lunedì Zona A'], ['Martedì Zona A'], ['Mercoledì Zona A'], ['Giovedì Zona A'], ['Venerdì Zona A'],['Sabato Zona A'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Seleziona il giorno della settimana"];
  $telegram->sendMessage($content);
}
if ($text == 'Zona B') {
  $option = [['Lunedì Zona B'], ['Martedì Zona B'], ['Mercoledì Zona B'], ['Giovedì Zona B'], ['Venerdì Zona B'],['Sabato Zona B'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Seleziona il giorno della settimana"];
  $telegram->sendMessage($content);
}

//Zona A
if ($text == 'Lunedì Zona A') {
  $option = [['Organico'], ['Zona A'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Lunedì in Zona A\n\n\xF0\x9F\x8D\x89 *Organico*\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Martedì Zona A') {
  $option = [['Carta e Cartone'], ['Zona A'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Martedì in Zona A\n\n\xF0\x9F\x93\xA6 *Carta e Cartone*\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Mercoledì Zona A') {
  $option = [['Organico'], ['Zona A'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Mercoledì in Zona A\n\n\xF0\x9F\x8D\x89 *Organico*\n\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Giovedì Zona A') {
  $option = [['Indifferenziato'], ['Zona A'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Giovedì in Zona A\n\n\xF0\x9F\x92\xA1 *Indifferenziato*\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Venerdì Zona A') {
  $option = [['Organico'], ['Zona A'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Venerdì in Zona A\n\n\xF0\x9F\x8D\x89 *Organico*\n\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Sabato Zona A') {
  $option = [['Plastica', 'Vetro e Lattine'], ['Zona A'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Domenica in Zona A\n\n\xF0\x9F\x8E\x88\xF0\x9F\x8D\xB7 *Plastica, Vetro e Lattine*\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}

//Zona B
if ($text == 'Lunedì Zona B') {
  $option = [['Carta e Cartone'], ['Zona B'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Lunedì in Zona B\n\n\xF0\x9F\x93\xA6 *Carta e Cartone*\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Martedì Zona B') {
  $option = [['Organico'], ['Zona B'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Martedì in Zona B\n\n\xF0\x9F\x8D\x89 *Organico*\n\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Mercoledì Zona B') {
  $option = [['Plastica', 'Vetro e Lattine'], ['Zona B'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Mercoledì in Zona B\n\n\xF0\x9F\x8E\x88\xF0\x9F\x8D\xB7 *Plastica, Vetro e Lattine*\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Giovedì Zona B') {
  $option = [['Organico'], ['Zona B'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Giovedì in Zona B\n\n\xF0\x9F\x8D\x89 *Organico*\n\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Venerdì Zona B') {
  $option = [['Indifferenziato'], ['Zona B'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Venerdì in Zona B\n\n\xF0\x9F\x92\xA1 *Indifferenziato*\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}
if ($text == 'Sabato Zona B') {
  $option = [['Organico'], ['Zona B'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Domenica in Zona B\n\n\xF0\x9F\x8D\x89 *Organico*\n\n\nEsporre dalle ore 20:00 alle ore 24:00"];
  $telegram->sendMessage($content);
}

//Materiali
if ($text == 'Materiali') {
  $option = [['Carta e Cartone','Plastica'], ['Vetro e Lattine','Organico'], ['Indifferenziato','Ingombranti'],['Menu Principale']];

  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "Seleziona il materiale"];
  $telegram->sendMessage($content);
}
if ($text == 'Carta e Cartone') {
    //DESCRIZIONE
    $reply = "\xF0\x9F\x93\xA6 Carta e Cartone";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI AMMESSI
    $reply = "\xE2\x9C\x85\nGiornali e riviste\nLibri e quaderni\nFotocopie e fogli vari\nCartoni piegati\nImballaggi e scarti per alimenti";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI NON AMMESSI
    $reply = "\xE2\x9D\x8C\nNylon\nCellophane\nCarta oleata\nCarta carbone e chimica\nPergamena\nScontrini";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
}
if ($text == 'Plastica') {
    //DESCRIZIONE
    $reply = "\xF0\x9F\x8E\x88 Plastica";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI AMMESSI
    $reply = "\xE2\x9C\x85\nBottiglie di acqua e bibite\nBottiglie di shampoo\nFlaconi per detergenti\nFlaconi per prodotti cosmetici liquidi\nContenitori per liquidi in genere\nFilm di nylon\nBorsette di polistirolo";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI NON AMMESSI
    $reply = "\xE2\x9D\x8C\nPiatti di plastica\nBicchieri di plastica\nPosate di plastica";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
}
if ($text == 'Vetro e Lattine') {
    //DESCRIZIONE
    $reply = "\xF0\x9F\x8D\xB7 Vetro e Lattine";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI AMMESSI
    $reply = "\xE2\x9C\x85\nBottiglie in vetro\nVasi in vetro\nBarattoli in vetro\nLattine in alluminio (simbolo AL)\nScatolette e lattine\nContenitori in metallo (pelati, tonno)";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI NON AMMESSI
    $reply = "\xE2\x9D\x8C\nBicchieri\nOggetti in ceramica e porcellana\nLampadine\nContenitori etichettati \"T\" e \"F\"\nVetri vari anche se rotti";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
}
if ($text == 'Indifferenziato') {
    //DESCRIZIONE
    $reply = "\xF0\x9F\x92\xA1 Indifferenziato";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI AMMESSI
    $reply = "\xE2\x9C\x85\nGomma\nCassette audio e video\nCD\nCellophane\nPiatti e posate in plastica\nCarta oleata o plastificata\nCalze in nylon\nCocci di ceramica\nPannolini\nAssorbenti\npolveri dell'aspirapolvere\nScarpe vecchie\nLampadine";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI NON AMMESSI
    $reply = "\xE2\x9D\x8C\nRifiuti riciclabili\n";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
}
if ($text == 'Organico') {
    //DESCRIZIONE
    $reply = "\xF0\x9F\x8D\x89 Organico";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI AMMESSI
    $reply = "\xE2\x9C\x85\nScarti di cucina\nAvanzi di cibo\nGusci d'uovo\nScarti di verdura e frutta\nFondi di caffè\nFiltri di the\nLettiere di piccoli animali domestici\nFiori recisi e piante domestiche\nSalviette di carta unte\nCeneri spente di caminetti\nPiccole ossa e gusci di cozze";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI NON AMMESSI
    $reply = "\xE2\x9D\x8C\nPannolini\nAssorbenti\nStracci anche se bagnati";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
}

if ($text == 'Ingombranti') {
    //DESCRIZIONE
    $reply = "\xF0\x9F\x92\xBB Ingombranti";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI AMMESSI
    $reply = "\xE2\x9C\x85\nTV\nArredi e materassi\nComputer e stampanti\nPersiane e tapparelle\nStufe - Termosifoni\nPiccoli elettrodomestici\nGrandi elettrodomestici";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
    //MATERIALI NON AMMESSI
    $reply = "\xE2\x9D\x8C\nSanitari\nMateriale edile\nMateriale ferroso\nMateriali tossici e pericolosi";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
}

//Informazioni utili dal comune
if ($text == 'Informazioni utili') {
    $reply = "*Suggerimenti forniti dal Comune:*\n\n\xF0\x9F\x93\xB1 *NUMERO: 0000000000*\n\n1) INSERISCI SUGGERIMENTO.*\n\n2) INSERISCI SUGGERIMENTO.*\n\n3) INSERISCI SUGGERIMENTO.\n\n4) INSERISCI SUGGERIMENTO. \n\n5) INSERISCI SUGGERIMENTO";
    $content = ['chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'markdown'];
    $telegram->sendMessage($content);
}
//Crediti
if ($text == 'Crediti') {
    $reply = "Questo Bot Telegram non è in alcun modo affiliato al Comune di XXXXXXXXXXX.\n\nE' un semplice strumento per il cittadino che trae informazioni dal sito istituzionale del comune: http://www.sitocomune.it/";
    $content = ['chat_id' => $chat_id, 'parse_mode' => 'markdown', 'text' => $reply];
    $telegram->sendMessage($content);
}

//Notifiche
if ($text == 'Notifiche') {
  $option = [['Si','No'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*NOTIFICHE*\n\nVuoi ricevere una notifica dal *Lunedì al Sabato* per avvisarti di portare fuori i rifiuti?"];
  $telegram->sendMessage($content);
}
if ($text == 'Si') {
  //Modifica con i nomi delle zone
  $option = [['Notifiche Zona A'], ['Notifiche Zona B'],['Notifiche'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Seleziona la tua zona di residenza:*\nZona A\nZona B"];
  $telegram->sendMessage($content);
}
if ($text == 'Notifiche Zona A') {
  //La Zona A nel database è rilevabile con il numero 1
  $option = [['Notifiche'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Grazie per aver attivato le notifiche*\n\nPotrai cambiare idea in qualunque momento."];
  $telegram->sendMessage($content);

  //Notifiche in DB
  $sql = "UPDATE differenziatabot SET attivo = '1',zona = '1' WHERE id_utente = $chat_id";

  if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
  } else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
  //Fine Memorizza chatID in DB
}
if ($text == 'Notifiche Zona B') {
  //La Zona B nel database è rilevabile con il numero 2
  $option = [['Notifiche'],['Menu Principale']];
  // Create a permanent custom keyboard
  $keyb = $telegram->buildKeyBoard($option, $onetime = false);
  $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'parse_mode' => 'markdown', 'text' => "*Grazie per aver attivato le notifiche*\n\nPotrai cambiare idea in qualunque momento."];
  $telegram->sendMessage($content);

  //Notifiche in DB

  $sql = "UPDATE differenziatabot SET attivo = '1',zona = '2' WHERE id_utente = $chat_id";

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
// Fine Notifiche


?>
