# impfbenachrichtigung-nds-bot
In diesem Repository ist eine minimalistische Möglichkeit implementiert, E-Mail Benachrichtigungen zu erhalten, sofern Impfplätze im lokalen Impfzentrum frei sind.

Ob für Vektor-Impfstoffe, für mRNA-Impfstoffe oder für beide Varianten, kann beliebig konfiguriert werrden.

Geeignet ist dieses Ergebnis insbesondere für Personen, die z.B. cronjobs auf einem Server einrichten möchten, damit der Bot unabhängig vom heimischen Computer läuft. Es genügt dabei, die check-vaccine.php im Wurzelverzeichnis aufzurufen.

## Features
* E-Mail Benachrichtigung wenn gewünschter Impfstofftyp im Impfzentrum in der Nähe verfügbar ist.

## Einrichtung
* Repository herunterladen
* Check-vaccine.php mit einem Text-Editor öffnen
* Alle Felder in der "CONFIGURATION AREA" ausfüllen. WICHTIG!
* Empfehlung: Erstellen Sie sich für den Versand der E-Mails ein neues Postfach. Z.B. bei GMX. ACHTUNG: Bevor E-Mails überhaupt versendet werden können, muss bei GMX unter "E-Mail > Einstellungen > POP3/IMAP Abruf" der Haken bei "POP3 und IMAP Zugriff erlauben" gesetzt werden. Sonst kann es nicht funktionieren.
* Datei mit Änderungen speichern

Der gesamte Ordner kann dann auf einen beliebigen Webspace geladen werden. Natürlich geht's auch mit einem lokalen Webserver. Anschließend kann wenn gewünscht ein cronjob eingerichtet werden, der z.B. alle 30 Minuten die check-vaccine.php aufruft. Bitte lassen Sie das Skript nicht zu häufig aufrufen, um die Server des Impfportals nicht unnötig zu belasten.

## Problemlösung
* Wenn keine E-Mails ankommen, liegt es höchstwahrscheinlich daran, dass die Autentifizierung beim Sender-Postfach fehlschlägt. Getestet wurde dies lediglich mit einem neuen GMX-Postfach. Stellen Sie in jedem Fall sicher, dass unter "E-Mail > Einstellungen > POP3/IMAP Abruf" der Haken bei "POP3 und IMAP Zugriff erlauben" gesetzt wurde. Das gleiche sollte für WEB.de gelten.

## Sonstiges
Wenn Ihnen das Projekt geholfen hat oder einfach gefällt, lassen Sie es mich gerne über den Diskussion-Bereich im Github-Repository wissen. 

Wenn Sie das Tool nicht selber betreiben wollen/können, lassen Sie es mich gerne über das Kontaktformular auf https://lubomedia.de wissen.