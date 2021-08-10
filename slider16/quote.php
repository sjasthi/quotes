<?php $page_title = ' Catch a Phrase'; ?>
<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
require 'db_credentials.php';
include("./nav.php");

include("puzzlemaker.php");
//error_reporting(0);
?>

<head>
    <meta charset="UTF-8">
    <title>
        Catch a Phrase (Snake)
    </title>
    <link type="text/css" media="all" href="phrase_style.css" rel="stylesheet" />
    <script src="phrase_scripts.js"></script>
</head>

<body>
    <!-- input form for phrase and filler values -->
    <form action="javascript:" method="get" onsubmit="event.preventDefault(); gen(false)">
        <!-- phrase values, each character should be separated by commas -->
        <label for="phrase" id="phraseLabel">Phrase</label>
        <input type="text" class="inputBox" name="phrase" id="phrase" value="తె,లు,గు,ప,జి,ల్స్" title="characters should be separated by commas, e.g.: a,bc, d" spellcheck="false" autocomplete="off" required>
        <br><br>

        <!-- Filler values -->
        <label for="fillers" id="fillersLabel">Fillers</label>
        <textarea name="fillers" class="inputBox" id="fillers" title="characters should be separated by commas, e.g.: a,bc, d" spellcheck="false" autocomplete="off" required> అ,ఆ,ఇ,ఈ,ఉ,ఊ,ఋ,ఎ,ఏ,ఐ,ఒ,ఓ,ఔ,అం,అః,క,ఖ,గ,ఘ,జ్ఞ,చ,ఛ,జ,ఝ,ఞ,ట,ఠ,డ,ఢ,ణ,త,థ,ద,ధ,న,ప,ఫ,బ,భ,మ,య,ర,ల,వ,శ,ష,స,హ,ళ,క్ష,ఱ,క,కా,కి,కీ,కు,కూ,కె,కే,కై,కొ,కో,కౌ,కం,ఖ,ఖా,ఖి,గ,గా,గి,గీ,గు,గూ,గె,గే,గై,గొ,గో,గౌ,గం,ఘ,ఘా,ఘి,ఘీ,ఘం,చ,చా,చి,చీ,చు,చూ,చె,చే,చై,చొ,చో,చౌ,చం,ఛ,ఛా,ఛి,ఛీ,ఛు,ఛూ,ఛె,ఛే,జ,జా,జి,జీ,జు,జూ,జె,జే,జై,జొ,జో,జం,ఝ,ట,టా,టి,టీ,టు,టూ,టె,టే,టై,టొ,టో,టం,ఠ,ఠి,ఠీ,డ,డా,డి,డీ,డు,డూ,డె,డే,డై,డొ,డో,డౌ,డం,ఢ,ఢా,ఢి,ఢీ,ఢు,ఢూ,ణం,త,తా,తి,తీ,తు,తూ,తె,తే,తై,తొ,తో,తౌ,తం,థ,థా,థి,థీ,ద,దా,ది,దీ,దు,దూ,దె,దే,దై,దొ,దో,దౌ,దం,ధ,ధా,ధి,ధీ,ధు,ధూ,ధె,ధే,ధై,ధొ,ధో,ధౌ,ధం,న,నా,ని,నీ,ను,నూ,నె,నే,నై,నొ,నో,నౌ,నం,ప,పా,పి,పీ,పు,పూ,పె,పే,పై,పొ,పో,పౌ,పం,ఫ,ఫా,ఫి,బ,బా,బి,బీ,బు,బూ,బె,బే,బై,బొ,బో,బౌ,బం,భ,భా,భి,భీ,భు,భూ,భె,భే,భై,భొ,భో,భౌ,భం,మ,మా,మి,మీ,ము,మూ,మె,మే,మై,మొ,మో,మౌ,మం,య,యా,యి,యీ,యు,యూ,యొ,యే,యై,యొ,యో,యౌ,యం,ర,రా,రి,రీ,రు,రూ,రె,రే,రై,రొ,రో,రౌ,రం,ల,లా,లి,లీ,లు,లూ,లె,లే,లై,లొ,లో,లౌ,లం,వ,వా,వి,వీ,వు,వూ,వె,వే,వై,వొ,వో,వౌ,వం,శ,శా,శి,శీ,శు,శూ,శె,శే,శై,శొ,శో,శౌ,శం,ష,షా,షి,స,సా,సి,సీ,సు,సూ,సె,సే,సై,సొ,సో,సౌ,సం,హ,హా,హి,హీ,హు,హూ,హొ,క్క,గ్గ,చ్చ,జ్జ,ట్ట,డ్డ,త్త,ద్ద,న్న,ప్ప,బ్బ,మ్మ,య్య,ర్ర,ల్ల,వ్వ,స్స,ల్ల,క్క,క్ర,క్ల,క్వ,క్ష,క్స,త్క,త్ప,స్త్రీ,ష్ట్ర,స్త్ర,త్స్న,వ్యా,ర్మూ,ద్రా,జా,స్తి,శి,వ,రా,మ</textarea>
        <br><br>

        <!-- Height dropdown selector, default value is 10 -->
        <label for="height">Grid Height:</label>
        <select name="height" id="height" autocomplete="off">
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12" selected>12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
        </select>
        <br><br>

        <!-- Width dropdown selector, default value is 10 -->
        <label for="width">Grid Width:</label>
        <select name="width" id="width" autocomplete="off">
            <option value="10" selected>10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16" selected>16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
        </select>
        <br><br>

        <input type="submit" name="generate" id="generate" value="Generate" id="generate">
        <br><br>

        <!-- show grids on startup -->
        <script>
            gen(true);
        </script>
    </form>
</body>

</html>