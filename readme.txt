=== MailPoet HTTP API ===
Contributors: hiorgserver
Tags: mailpoet http post api
Requires at least: 3.0
Tested up to: 4.3.1
License: GPL

HTTP API, um neue Abonnenten zu MailPoet hinzuzufügen

== Description ==
Fügen Sie neue Abonnenten zu MailPoet hinzu, indem Sie eine Seite Ihres WP-Blogs aufrufen und
dabei Name und E-Mail-Adresse als POST-Parameter übergeben.
 
== Installation ==
= Voraussetzungen =
* WordPress Version 3.0 und später (getestet mit 4.3.x)
 
= Installation =
1. Plugin im Menü 'Plugins' installieren und aktivieren
1. Erstellen Sie eine neue Seite (ohne Verlinkung im Menü), welche den Shortcode [http2mailpoet] enthält
1. Rufen Sie die URL dieser neuen Seite auf, und übergeben Name und E-Mail-Adresse in den POST-Parametern "lastname" und "email"

Die IDs der Ziel-Listen können als Parameter "list_ids" (kommasepariert) oder "list_id" (nur eine ID) übergeben werden - 
entweder ebenfalls als POST-Parameter, oder als Parameter im Shortcode.

Wenn im Shortcode ein Parameter "secret" gesetzt wird, dann wird die API nur ausgeführt, wenn der gleiche Inhalt
auch in einem POST-Parameter "secret" mitgesendet wird.
 
== Screenshots ==
nothing here
 
== Other Notes ==
= Acknowledgements =
nothing here
 
= License =
Gute Nachrichten! Da dieses Plugin unter der GPL veröffentlicht wurde, kann es sowohl privat als auch kommerziell genutzt werden.
 
== Changelog ==
= v0.2 (2016-02-11) =
* Parameter "secret" eingeführt
= v0.1 (2016-02-10) =
* Erste Veröffentlichung des Plugins.
