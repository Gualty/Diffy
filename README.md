# BOTDifferenziata ![Differenziata](https://apps.timwhitlock.info/static/images/emoji/emoji-apple/267b.png)
Bot Telegram per la gestione della raccolta differenziata nei comuni.

Funzioni
---------
* Calendario raccolta rifiuti
* Dettagli sui singoli materiali riciclabili e non
* Informazioni utili fornite dal comune.
* Supporto ai grandi comuni con più zone

Materiali supportati
---------
🍉 Organico
📦 Carta e Cartone
💡 Indifferenziato
🎈 Plastica
🍷 Vetro e Lattine
💻 Ingombranti

BOT già attivi
---------
[@DiffSGLaPuntabot](https://telegram.me/DiffSGLaPuntabot) - Raccolta differenziata San Giovanni la Punta (CT)

[@DiffGravinaCTbot](https://telegram.me/DiffGravinaCTbot) - Raccolta differenziata Gravina di Catania (CT)

[@DiffAdranobot](https://telegram.me/DiffAdranobot) - Raccolta differenziata Adrano (CT)

Requisiti
---------
* PHP >= 5.3
* Estensione curl di PHP5 attiva
* Server con supporto HTTPS (in rete ne esistono anche di gratuiti)

Per iniziare
---------
⚠️ La presente sezione non è ancora completa ⚠️

1) Dai un'occhiata alla documentazione ufficiale sul sito [Telegram.org](https://core.telegram.org/bots)
2) Segui le istruzioni su come attivare un bot con [BotFather](https://core.telegram.org/bots#6-botfather) e generare un TOKEN
3) Scarica l'[ultima release](https://github.com/Gualty/BOTDifferenziata/releases/latest) di BOTDifferenziata
4) Apporta le modifiche per inserire i contenuti del tuo comune
5) Esegui l'upload di tutti i file sul tuo server (N.B. Si consiglia di creare una sottocartella così da poter supportare più bot sullo stesso server)
6) Apri il browser e visita https://api.telegram.org/bot(BOT_TOKEN)/setWebhook?url=https://iltuoserver.it/cartellabot/index.php

N.B. Assicurati di sostituire (BOT TOKEN), togliendo pure le parentesi, con il token generato da BotFather e di inserire correttamente l'url, compreso di sottocartella, al file index.php del BOT

Crediti
---------
Il BOTDifferenziata si basa sul framework [TelegramBotPHP](https://github.com/Eleirbag89/TelegramBotPHP) realizzato da Eleirbag89.
