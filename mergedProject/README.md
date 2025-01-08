# Hotelprojekt Liu, Harich

## Beschreibung

Dieses Projekt im Rahmen der Lehrveranstaltung Webtechnologien diente dem Erlernen des Programmierens einer Website mit Datenbankanbindung. Als konkrete Aufgabe war eine Hotelwebseite zu implementieren, mit Informationsseiten wie News-Beiträgen, einem Impressum und einer Hilfeseite, sowie der Möglichkeit sich einzuloggen und erweiterter Funktionalität für registrierte User - zB. das reservieren von Zimmern oder Verwalten der eigenen Nutzerdaten. Außerdem gibt es einen admin-User, der zusätzlich in der Lage ist, direkt online die Nutzer- und Reservierungsdaten der gesamten Webseite zu bearbeiten, sowie neue Blogbeiträge zu erstellen.

## Dateiüberblick

(Hier werden im Moment nur files gelistet, die bereits in bereits kommentierten aufgetaucht sind, und daher schon auf der Liste der nächsten stehen..)

- [x] index.php

### include

- [x] fct_login.php
- [ ] fct_logout.php
- [x] fct_register.php
- [x] fct_session.php
- [x] footer.php
- [x] header.php 
- [x] navbar.php
- [ ] site_blog.php
- [ ] site_dashboard.php
- [x] site_help.php
- [x] site_impressum.php
- [x] site_logout.php

### config

- [x] dbaccess.php

### res/css

- [x] styles.css

## evtl. noch zu ändern

- Bilder auf Startseite responsive
- Login & Registrierung in navbar nur für anonyme anzeigen
- fct_login & fct_register zu site_login & site_register umbenennen (Achtung: alle links!)
    - fct_register aufteilen in Funktion und Seite (Seite beginnt in Zeile 81)
- site_logout mit header.php noch kürzer machen, dafür footer einbinden