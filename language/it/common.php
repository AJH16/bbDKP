<?php
/**
 * bbguild common language file - [Italian]
 * @author lucasari
 * @package phpBB Extension - bbguild
 * @copyright 2011 bbguild <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author sajaki <sajaki@gmail.com>
 * @link http://www.avathar.be/bbdkp
 * @version 2.0
 *
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
    exit;
}

/**
 * DO NOT CHANGE
 */
if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
    'BBDKPDISABLED' => 'bbDKP è attualmente disabilitato.',
    'FOOTERBBDKP' => 'bbDKP',

//---- Portal blocks -----
    'PORTAL' => 'Portale',
    'USER_MENU'			=> 'menù Utente',
    'RECENTLOOT' => 'Ultimi Oggetti',
    'REMEMBERME' => 'Ricordami',
    'INFORUM' => 'Inserito',
    'DKP' => 'DKP',
    'NEWS' => 'News',
    'COMMENT' => 'Commenti',
    'LIST_NEWS' => 'Lista News',
    'NO_NEWS' => 'Nessuna news trovata.',
    'NEWS_PER_PAGE' => 'News per pagina',
    'ERROR_INVALID_NEWS_PROVIDED' => 'Non è stato inserito un ID news valido.',
    'BOSSPROGRESS' => 'Bossprogress',
    'WELCOME' => 'Benvenuto',
    'RECENT_LENGTH' => 'Numero di personaggi associati',
    'NUMTOPICS' => 'Numero di discussioni associate',
    'SHOW_RT_BLOCK' => 'Mostra le ultime discussioni',
    'RECENT_TOPICS_SETTING' => 'Impostazioni Discussioni Recenti',
    'RECENT_TOPICS' => 'Discussioni Recenti',
    'NO_RECENT_TOPICS' => 'Nessuna Discussione Recente',
    'POSTED_BY_ON' => 'da %1$s il %2$s',
    'LATESTPLAYERS' => 'Ultimi Iscritti',

// Main Menu
    'MENU' => 'Menù',
    'MENU_ADMIN_PANEL' => 'Pannello Amministrativo',
    'MENU_BOSS' => 'Bossprogress',
    'MENU_EVENTS' => 'Eventi',
    'MENU_ITEMVAL' => 'Valore Oggetti',
    'MENU_ITEMHIST' => 'Storico Oggetti',
    'MENU_NEWS' => 'News',
    'MENU_RAIDS' => 'Incursioni',
    'MENU_ROSTER' => 'Roster',
    'MENU_STATS' => 'Statistiche',
    'MENU_SUMMARY' => 'Sommario',
    'MENU_STANDINGS' => 'Classifiche',
    'MENU_VIEWPLAYER' => 'Lista Personaggi',
    'MENU_VIEWITEM' => 'Vedi Oggetti',
    'MENU_VIEWRAID' => 'Vedi Incursioni',
    'MENU_VIEWEVENT' => 'Vedi Eventi',
    'MENU_PLANNER' => 'Calendario',

//links
    'MENU_LINKS' => 'Weblinks',
    'LINK1' => 'http://www.avathar.be/bbdkp',
    'LINK1T' => 'Powered By: bbDKP',
    'LINK2' => 'http://uk.aiononline.com',
    'LINK2T' => 'Aion Online',
    'LINK3' => 'http://darkageofcamelot.com',
    'LINK3T' => 'Dark age of Camelot',
    'LINK4' => 'http://everquest2.station.sony.com/',
    'LINK4T' => 'Everquest 2',
    'LINK5' => 'http://www.playonline.com/ff11us/index.shtml',
    'LINK5T' => 'FFXI',
    'LINK6' => 'http://de.finalfantasyxiv.com/lodestone/',
    'LINK6T' => 'FFXIV',
    'LINK7' => 'http://www.guildwars2.com',
    'LINK7T' => 'Guild Wars 2',
    'LINK8' => 'http://www.lineage2.com',
    'LINK8T' => 'Lineage 2',
    'LINK9' => 'http://www.lotro.com',
    'LINK9T' => 'Lord of the Rings',
    'LINK10' => 'http://www.riftgame.com',
    'LINK10T' => 'Rift',
    'LINK11' => 'http://www.swtor.com',
    'LINK11T' => 'Star Wars : ToR',
    'LINK12' => 'http://tera.enmasse.com/',
    'LINK12T' => 'Tera',
    'LINK13' => 'http://www.vanguardmmorpg.com',
    'LINK13T' => 'Vanguard',
    'LINK14' => 'http://www.warhammeronline.com',
    'LINK14T' => 'Warhammer',
    'LINK15' => 'http://www.worldofwarcraft.com',
    'LINK15T' => 'World of Warcraft',

//games preinstalled
    'AION'       => 'Aion' ,
    'DAOC'       => 'Dark Age of Camelot' ,
    'EQ'         => 'EverQuest' ,
    'EQ2'        => 'EverQuest II' ,
    'FFXI'       => 'Final Fantasy XI',
    'GW2'    => 'GuildWars 2',
    'LINEAGE2'   => 'Lineage 2',
    'LOTRO'      => 'Lord of the Rings Online' ,
    'RIFT'       => 'Rift',
    'SWTOR'      => 'Starwars : The old Republic',
    'TERA'    => 'Tera',
    'VANGUARD'  => 'Vanguard Saga of Heroes' ,
    'WARHAMMER'  => 'Warhammer Online' ,
    'WOW'        => 'World of Warcraft' ,
    'FFXIV'        => 'Final Fantasy XIV' ,
    'PREINSTALLED' => 'Preinstalled games: %s',

//Recruitment
    'RECRUITMENT_BLOCK' => 'Reclutamento',
    'RECRUIT_CLOSED' => 'Chiusa !',
    'TANK' => 'Difensore',
    'DPS' => 'Assaltatore' ,
    'HEAL' => 'Curatore',
    'HEALER' => 'Curatore',
    'RECRUIT_MESSAGE' => 'Attualmente stiamo cercando giocatori per le seguenti specializzazioni:',

//ROSTER
    'GUILDROSTER' => 'Elenco personaggi',
    'RANK'   => 'Grado',
    'CLASS'   => 'Classe',
    'LVL'   => 'Level',
    'REALM'  => 'Reame',
    'REGION'  => 'Regione',
    'ACHIEV'  => 'Imprese',
    'PROFFESSION' => 'Professioni',

//listplayers
    'ADJUSTMENT' => 'Modifiche',
    'ALL' => 'Tutti',
    'CURRENT' => 'Correnti',
    'EARNED' => 'Acquisiti',
    'FILTER' => 'Filtro',
    'LASTRAID' => 'Ultima Incursione',
    'LEVEL' => 'Livello',
    'LISTPLAYERS_TITLE' => 'Classifiche Giocatori',
    'MNOTFOUND' => 'Informazioni Aggiuntive non disponibili',
    'RNOTFOUND' => 'Informazioni Incursione non disponibili',
    'EMPTYRAIDNAME' => 'Incursione Non Trovata',
    'NAME' => 'Nome',
    'POOL' => 'Gruppi Punteggio',
    'RAID_ATTENDANCE_HISTORY' => 'Storico Presenze Incursioni',
    'RAIDS_LIFETIME' => 'Scadenza (%s - %s)',
    'ATTENDANCE_LIFETIME' => 'ATTENDANCE_LIFETIME',
    'RAIDS_X_DAYS' => 'Ultimi %d Giorni',
    'SPENT' => 'Spesi',
    'COMPARE_PLAYERS' => 'Confronta Personaggi',
    'LISTPLAYERS_FOOTCOUNT' => '... trovati %d Personaggi',
    'SURNAME' => 'Nome/Titolo',
    'LISTADJ_TITLE' => 'Lista Modifiche',
    'LISTEVENTS_TITLE' => 'Valore Evento',
    'LISTIADJ_TITLE' => 'Lista Modifiche Individuali',
    'LISTITEMS_TITLE' => 'Valore Oggetti',
    'LISTPURCHASED_TITLE' => 'Storico Oggetti',
    'LISTRAIDS_TITLE' => 'Lista Incursioni',
    'LOGIN_TITLE' => 'Login',
    'STATS_TITLE' => '%s Statistiche',
    'TITLE_PREFIX' => '%s %s',
    'VIEWEVENT_TITLE' => 'Visualizza Storico Incursioni di %s',
    'VIEWITEM_TITLE' => 'Visualizza Storico Acquisti per %s',
    'VIEWPLAYER_TITLE' => 'Storico per %s',
    'VIEWRAID_TITLE' => 'Lista Incursioni',
    'NODKPACCOUNTS' => 'Nessunt account DKP trovato',
    'NOUCPACCESS' => 'Non sei autorizzato ad associarti personaggi',
    'NOUCPADDCHARS' => 'Non sei autorizzato ad aggiungere personaggi',
    'NOUCPUPDCHARS' => 'Non sei autorizzato ad aggiornare personaggi',
    'NOUCPDELCHARS' => 'Non sei autorizzato a cancellari personaggi',

// Various
    'ACCOUNT' => 'Account',
    'ACTION' => 'Azioni',
    'ADD' => 'Aggiungi',
    'ADDED_BY' => 'Aggiunto da %s',

    'ADMINISTRATION' => 'Amministrazione',
    'ADMINISTRATIVE_OPTIONS' => 'Opzioni Amministrazione',
    'ADMIN_INDEX' => 'Indice Amministrazione',
    'ATTENDANCE_BY_EVENT' => 'Presenze per evento',
    'ATTENDED' => 'Partecipato',
    'ATTENDEES' => 'Partecipanti',
    'ATTENDANCE' => 'Presenza',
    'ATT' => 'Pre.',
    'AVERAGE' => 'Media',
    'BOSS' => 'Boss',
    'BUYER' => 'Compratore',
    'BUYERS' => 'Compratori',
    'ARMOR' => 'Armatura',
    'STATS_SOCIAL' => '< 20% Presenza',
    'STATS_RAIDER' => '< 50% Presenza',
    'STATS_CORERAIDER' => '> 70% Presenza',

// TYPES of armor are static across games, no need to put it in DB
    'CLOTH' => 'Molto Leggera / Stoffa',
    'ROBE' => 'Robes',
    'LEATHER' => 'Leggera / Pelle',
    'AUGMENTED' => 'Augmented Suit',
    'MAIL' =>  'Media / Maglia',
    'HEAVY' => 'Armatura Pesante',
    'PLATE' => 'Pesante / Piastre',

    'CLASSID' => 'ID Classe',
    'CLASS_FACTOR' => 'Fattore di Classe',
    'CLASSARMOR' => 'Tipo Armatura',
    'CLASSIMAGE' => 'Immagine',
    'CLASSMIN' => 'Livello Minimo',
    'CLASSMAX' => 'Livello Massimo',
    'CLASS_DISTRIBUTION' => 'Distribuzione per Classe',
    'CLASS_SUMMARY' => 'Sommario per Classe da %s a %s',
    'CONFIGURATION' => 'Configurazione',
    'CLOSED' => 'Chiuso',
    'DATE' => 'Data',
    'DELETE' => 'Cancella',
    'DELETE_CONFIRMATION' => 'Conferma Cancellazione',
    'DKP_VALUE' => 'Vale %s',

    'NO_CHARACTERS' => 'Nessun Personaggio nel Database',
    'STATUS' => 'Stato S/N',
    'CHARACTER' => 'Questa è la lista di tutti i tuoi Personaggi. ',
    'CHARACTER_EXPLAIN' => 'Scegli un Personaggio che non è ancora stato associato.',
    'CHARACTERS_UPDATED' => 'Il Personaggio %s è stato assegnato al tuo account. ',
    'NO_CHARACTERS_BOUND' => 'Nessun Personaggio collegato al tuo account.',

    'DROPS' => 'Bottino',
    'EVENTNOTE' => 'Note: only lists attended raids or obtained loot from active events.',
    'EVENT' => 'Evento',
    'EVENTNAME' => 'Nome Evento',
    'EVENTS' => 'Eventi',
    'FACTION' => 'Fazione',
    'FACTIONID' => 'ID Fazione',
    'FIRST' => 'Primo',
    'HIGH' => 'Alto',
    'ADJUSTMENTS' => 'Correzioni',
    'ADJUSTMENT_HISTORY' => 'Storico Correzioni',
    'INDIV_ADJ' => 'Corre. Individ.',
    'ITEM' => 'Oggetto',
    'ITEMS' => 'Oggetti',
    'ITEMVALUE' => 'Valore Oggetto',
    'ITEMDECAY' => 'Decadimento Oggetto',
    'ITEMTOTAL' => 'Valore Totale',
    'ITEM_PURCHASE_HISTORY' => 'Storico Acquisto Oggetti',
    'JOINDATE' => 'Data Ingresso in Gilda',
    'LAST' => 'Ultimo',
    'LASTLOOT' => 'Ultimo Bottino',
    'LAST_VISIT' => 'Ultima Visita',
    'LAST_UPDATE' => 'Last Aggiornamento',
    'LOG_DATE_TIME' => 'Data/Ora di questo Log',
    'LOOT_FACTOR' => 'Coefficiente Bottino',
    'LOOTS' => 'Bottini',
    'LOOTDIST_CLASS' => 'Distribuzione bottino per Classi',
    'LOW' => 'Basso',
    'MANAGE' => 'Gestisci',
    'MEDIUM' => 'Medio',
    'PLAYER' => 'Membro',
    'PLAYERS' => 'Membri',
    'NA' => 'N/A',
    'NETADJUSTMENT' => 'Net',
    'NETSPENT' => 'Net',
    'NO_DATA' => 'Nessun Dato',
    'NO_LOOT' => 'No Bottino',
    'NO_RAIDS' => 'Nessuna Incursione',
    'NO_ADJUSTMENTS' => 'Nessuna Modifica',
    'RAID_ON' => 'Incursione del %s il %s',
    'MAX_CHARS_EXCEEDED' => 'Spiacente, puoi avere solamente %s Personaggi associati al tuo account del Forum.',
    'MISCELLANEOUS' => 'Varie',
    'NEWEST' => 'Ultime Incursioni',

    'NOTE' => 'Note',
    'OLDEST' => 'Vecchie incursioni',
    'OPEN' => 'Aperto',
    'OPTIONS' => 'Opzioni',
    'OUTDATE' => 'Data abbandoni gilda',
    'PERCENT' => 'Percentuale',
    'PERMISSIONS' => 'Permessi',
    'PER_DAY' => 'Al Giorno',
    'PER_RAID' => 'Per Incursione',
    'PCT_EARNED_LOST_TO' => '% Acquisita e persa',
    'PREFERENCES' => 'Preferenze',
    'PURCHASE_HISTORY_FOR' => 'Storico Acquisti per %s',
    'LEADERBOARDSTAT' => 'Leaderboard vs. Raidcount',
    'QUOTE' => 'Cita',
    'RACE' => 'Razza',
    'RACEID' => 'Race ID',
    'RAIDSTART' => 'Inizio Incursione',
    'RAIDEND' => 'Fine Incursione',
    'RAIDDURATION' => 'Durata',
    'RAID' => 'Incursione',
    'RAIDCOUNT' => 'Conteggio Incursione',
    'RAIDS' => 'Incursioni',
    'RAID_ID' => 'ID Incursione',
    'RAIDVALUE' => 'Valore Incursione',
    'RAIDBONUS' => 'Bonus Incursione',
    'RANK_DISTRIBUTION' => 'Distribuzione Gradi',
    'RECORDED_RAID_HISTORY' => 'Storico Incursioni',
    'RECORDED_DROP_HISTORY' => 'Storico Acquisti',
    'REASON' => 'Motivazione',
    'RESULT' => 'Risultato',

    'SESSION_ID' => 'ID Sessione',

    'DAMAGE' => 'Assaltatore',
    'SUMMARY_DATES' => 'Sommario Incursione: %s a %s',
    'TIME' => 'Orario',
    'TIME_BONUS' => 'Orario Bonus',
    'TOTAL' => 'Totale',
    'TIMEVALUE' => 'Valore Orario',
    'TOTAL_ADJUSTMENTS' => 'Modifiche Totale',
    'TOTAL_EARNED' => 'Totale Acquisito',
    'TOTAL_ITEMS' => 'Totale Bottino',
    'TOTAL_RAIDS' => 'Totale Incursioni',
    'TOTAL_SPENT' => 'Total Speso',
    'TRANSFER_PLAYER_HISTORY' => 'Storico Trasferimenti Pesonaggio',
    'TYPE' => 'Tipo',
    'UPDATE' => 'Aggiornato',
    'UPDATED_BY' => 'Aggiornato da %s',
    'USER' => 'Utente',
    'USERNAME' => 'Username',
    'VALUE' => 'Valore',
    'VIEW' => 'Vedi',
    'VIEW_ACTION' => 'Vedi Azioni',
    'VIEW_LOGS' => 'Vedi Logs',
    'ZSVALUE' => 'SommaZero',
    'ZEROSUM' => 'Bonus SommaZero',

//lootsystems
    'EP' => 'EP',
    'EPLONG' => 'Punti Efficienza',
    'EPNET' => 'EP net',
    'EPNETLONG' => 'Net Effort Points',
    'GP' => 'GP',
    'GPLONG' => 'Punti Equipaggiamanto',
    'GPNET' => 'GP net',
    'PR' => 'PR',
    'PRLONG' => 'Fattore Priorità',
    'RAIDDECAY' => 'Decadimento Incursione',
    'ADJDECAY' => 'Modifiche decadimento',
    'DECAY' => 'Decadimento',

// Page Foot Counts

    'LISTEVENTS_FOOTCOUNT' => '... trovati %d eventi',
    'LISTIADJ_FOOTCOUNT' => '... trovate %d modifiche individuali / %d per pagina',
    'LISTITEMS_FOOTCOUNT' => '... trovati %d oggetti unici / %d per pagina',
    'LISTNEWS_FOOTCOUNT' => '... trovate %d Notizie sui Loot',
    'LISTPLAYERS_ACTIVE_FOOTCOUNT' => '... trovato %d mebri attivi / %sshow totale</a>',
    'LISTPLAYERS_COMPARE_FOOTCOUNT' => '... confronta %d mebri',
    'LISTPURCHASED_FOOTCOUNT' => '... trovato %d oggetto(i) / %d per pagina',
    'LISTPURCHASED_FOOTCOUNT_SHORT' => '... trovato %d oggetto(i)',
    'LISTRAIDS_FOOTCOUNT' => '... trovato %d incursione(i) / %d per pagina',
    'STATS_ACTIVE_FOOTCOUNT' => '... trovato %d mebri attivi / %sshow sul totale</a>',
    'STATS_FOOTCOUNT' => '... trovato %d membro(i) /%sshow attivi</a>',
    'VIEWEVENT_FOOTCOUNT' => '... trovato %d incursione(i)',
    'VIEWITEM_FOOTCOUNT' => '... trovato %d oggetto(i)',
    'VIEWPLAYER_ADJUSTMENT_FOOTCOUNT' => '... trovato %d modifica(che) individuale(i)',
    'VIEWPLAYER_ITEM_FOOTCOUNT' => '... trovato %d oggetto(i) acquistati / %d per pagina',
    'VIEWPLAYER_RAID_FOOTCOUNT' => '... trovato %d partecipazioni a incursioni / %d per pagina',
    'VIEWPLAYER_EVENT_FOOTCOUNT' => '... trovato %d partecipazioni ad eventi',
    'VIEWRAID_ATTENDEES_FOOTCOUNT' => '... trovato %d partceipante(i)',
    'VIEWRAID_DROPS_FOOTCOUNT' => '... trovato %d bottino(i)',

// Submit Buttons
    'LOG_ADD_DATA' => 'Add Data to Form',
    'PROCEED' => 'Procedi',
    'UPGRADE' => 'Aggiorna',

// Form Element Descriptions
    'ENDING_DATE' => 'Data Fine',
    'GUILD_TAG' => 'Tag di Gilda',
    'LANGUAGE' => 'Lingua',
    'STARTING_DATE' => 'Data Inizio',
    'TO' => 'A',

// Pagination
    'NEXT_PAGE' => 'Pagina Successiva',
    'PAGE' => 'Pagina',
    'PREVIOUS_PAGE' => 'Pagina Precedente',

// Permission Messages
    'NOAUTH_DEFAULT_TITLE' => 'Permesso Negato',
    'NOAUTH_U_EVENT_LIST' => 'Non hai il permesso di visualizzare lista eventi.',
    'NOAUTH_U_EVENT_VIEW' => 'Non hai il permesso di visualizzare eventi.',
    'NOAUTH_U_ITEM_LIST' => 'Non hai il permesso di elencare gli oggetti.',
    'NOAUTH_U_ITEM_VIEW' => 'Non hai il permesso di vedere gli oggetti.',
    'NOAUTH_U_PLAYER_LIST' => 'Non hai il permesso di vedere le classifiche utenti.',
    'NOAUTH_U_PLAYER_VIEW' => 'Non hai il permesso di vedere lo storico dei personaggi.',
    'NOAUTH_U_RAID_LIST' => 'Non hai il permesso di visualizzare l elenco incursioni.',
    'NOAUTH_U_RAID_VIEW' => 'Non hai il permesso di visualizzare le incursioni.',

// Miscellaneous
    'DEACTIVATED_BY_API' => 'Disattivato da API',
    'DEACTIVATED_BY_USR' => 'Disattivato da User',

    'ADDED' => 'Aggiunto',
    'BOSSKILLCOUNT' => 'Bosskills',
    'DELETED' => 'Cancellato',
    'ENTER_NEW' => 'inserisci nuovo nome',
    'ENTER_NEW_GAMEITEMID' => 'ID Oggetto (gioco)',
    'FEMALE' => 'Femmina',
    'GENDER' => 'Sesso',
    'GUILD' => 'Gilda',
    'LIST' => 'Elenco',
    'LIST_EVENTS' => 'Elenca Eventi',
    'LIST_INDIVADJ' => 'Elenca Modifiche Individuali',
    'LIST_ITEMS' => 'Elenco Oggetti',
    'LIST_PLAYERS' => 'Elenco Membri',
    'LIST_RAIDS' => 'Elenco Incursioni',
    'MALE' => 'Maschio',
    'MAY_BE_NEGATIVE_NOTE' => 'può essere negativo',
    'NOT_AVAILABLE' => 'Non Disponibile',
    'NORAIDS' => 'Nessuna Incursione',
    'OF_RAIDS' => '%d',
    'OF_RAIDS_CHAR' => '%s',
    'OR' => 'o',
    'REQUIRED_FIELD_NOTE' => 'Oggetti marcati con un * sono campi obbligatori.',
    'SELECT_EXISTING' => 'Seleziona Esistente',
    'UPDATED' => 'Aggiornato',
    'NOVIEW' => 'Nome Sconosciuto %s',
    'IRCTLIFE' => 'Ind.Conteggio vita',
    'GRCTLIFE' => 'Tut.Conteggio vita',
    'ATTLIFE' => 'Conteggio Life',
    'IRCT90' => 'Ind.Conteggio 90d',
    'GRCT90' => 'Tut.Conteggio 90d',
    'ATT90' => 'Conteggio 90d',
    'IRCT60' => 'Ind.Conteggio 60d',
    'GRCT60' => 'Tut.Conteggio 60d',
    'ATT60' => 'Conteggio 60d',
    'IRCT30' => 'Ind.Conteggio 30d',
    'GRCT30' => 'Tut.Conteggio 30d',
    'ATT30' => 'Conteggio 30d',

//---- About --- here be dragons

    'ABOUT' => 'About',
    'MAINIMG' => 'bbguild.png',
    'IMAGE_ALT' => 'Logo',
    'REPOSITORY_IMAGE' => 'Google.jpg',
    'TCOPYRIGHT' => 'Copyright',
    'TCREDITS' => 'Credits',
    'TEAM' => 'Dev Team',
    'TSPONSORS' => 'Donators',
    'TPLUGINS' => 'PlugIns',
    'CREATED' => 'Created by',
    'DEVELOPEDBY' => 'Developed by',
    'DEVTEAM' => 'bbDKP Development Team',
    'AUTHNAME' => 'Ippeh',
    'WEBNAME' =>'Website',
    'SVNNAME' => 'Repository',
    'SVNURL' => 'https://github.com/bbDKP',
    'WEBURL' => 'http://www.avathar.be/bbdkp',
    'WOWHEADID' => 'Wowhead id',
    'AUTHWEB' => 'http://www.avathar.be/bbdkp/',
    'DONATIONCOMMENT' => 'bbDKP is freeware, but you can support our development efforts by making a contribution.',
    'PAYPALLINK' => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
"><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt=""><img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>',
    'LICENSE1' => 'bbDKP is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   bbDKP is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with bbDKP.  If not, see http://www.gnu.org/licenses',
    'LICENSE2' => 'Powered by bbDKP (c) 2009 The bbDKP Project Team. If you use this software and find it to be useful, we ask that you retain the copyright notice below. While not required for free use, it will help build interest in the bbDKP project and is <strong>required for obtaining support</strong>.',
    'COPYRIGHT3' => 'bbDKP (c) 2010 Sajaki, Malfate, Blazeflack <br />
bbDKP (c) 2008, 2009 Sajaki, Malfate, Kapli, Hroar',
    'COPYRIGHT2' => 'bbDKP (c) 2007 Ippeh, Teksonic, Monkeytech, DWKN',
    'COPYRIGHT1' => 'EQDkp (c) 2003 The EqDkp Project Team ',

    'PRODNAME' => 'Product',
    'VERSION' => 'Version',
    'DEVELOPER' => 'Developer',
    'JOB' => 'Job',
    'DEVLINK' => 'Link',
    'PROD' => 'bbDKP',
    'DEVELOPERS' => '<a href=mailto:sajaki9@gmail.com>Sajaki</a>',
    'PHPBB' => 'phpBB',
    'PHPBBGR' => 'phpBB Group',
    'PHPBBLINK' => 'http://www.phpbb.com',
    'EQDKP' => 'Original EQDKP',
    'EQDKPVERS' => '1.3.2',
    'EQDKPDEV' => 'Tsigo',
    'EQDKPLINK' => 'http://www.eqdkp.com/',

    'PLUGINS' => 'Plugins',
    'PLUGINVERS' => 'Version',
    'AUTHOR' => 'Author',
    'MAINT' => 'Maintainer',
    'DONATION' => 'Donation',
    'DONA_NAME' => 'Name',
    'ADDITIONS' => 'Code Additions',
    'CONTRIB' => 'Contributions',

));