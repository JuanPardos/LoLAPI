<?php
ob_start("ob_gzhandler");
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link id="favicon" rel="shortcut icon" type="image/png" href="resources/icon.png">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/iziToast.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- JS -->
    <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="js/iziToast.min.js" type="text/javascript"></script>
    <script>
        $(function() {
            $("[rel='tooltip']").tooltip(); //Enables tooltips
        });
    </script>
    <title>Match info</title>
</head>

<body class="match" id="bd">
    <?php error_reporting(0); ?>
    <div class="container-fluid">
        <?php
        require_once 'key.php';              //Get the API Key from a .gitignored file (Hide from public).
        if ($apikey != $_SESSION['sapikey'] && $_SESSION['sapikey'] != null) {
            $apikey = $_SESSION['sapikey'];
        }
        require_once 'api/champapi.php';
        require_once 'api/matchapi.php';

        print '
            <div class="row">
                <div class="col-12 mt-1">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-borderless" id="matchTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="center">Champion</th>
                                    <th scope="col" class="center">Spells & Rune tree</th>
                                    <th scope="col" class="center">Level</th>
                                    <th scope="col" class="center">Summoner</th>
                                    <th scope="col" class="center">Stats</th>
                                    <th scope="col" class="center">Minions Killed</th>
                                    <th scope="col" class="center">Gold Earned</th>
                                    <th scope="col" class="center">Damage to Champions</th>
                                    <th scope="col" class="center">Vision Score</th>
                                    <th scope="col">Items</th>
                                </tr>
                            </thead>
                            <tbody>
                ';

        for ($i = 0; $i < 5; ++$i) {
            if ($data_match2['participants'][$i]['stats']['firstBloodKill'] == 'true') {
                $fb = "<img src='resources/fb.png' width='20' height='20' rel='tooltip' title='First Blood'>";
            }
            if ($data_match2['participants'][$i]['stats']['firstTowerKill'] == 'true') {
                $tw = "<img src='resources/tower.png' width='20' height='24' rel='tooltip' title='First Tower'>";
            }
            print '
                                <tr>
                                    <td class="center"><img src="resources/champion_icons/' . ucfirst($arrayID[$data_match2['participants'][$i]['championId']]) . '.png" width="42" height="42" rel="tooltip" title="' . $array[$data_match2['participants'][$i]['championId']] . '"></td>
                                    <td class="center">
                                        <img src="resources/summoner_spells/' . $data_match2['participants'][$i]['spell1Id'] . '.png" width="32" height="32">
                                        <img src="resources/summoner_spells/' . $data_match2['participants'][$i]['spell2Id'] . '.png" width="32" height="32">
                                        <img src="resources/runes/' . $data_match2['participants'][$i]['stats']['perkPrimaryStyle'] . '.png" width="24" height="24">
                                    </td>
                                    <td class="center">' . $data_match2['participants'][$i]['stats']['champLevel'] . '</td>
                                    <td class="center"><a href="../summoner.php?summoner=' . $data_match2['participantIdentities'][$i]['player']['summonerName'] . '&server=' . $server . '">' . $data_match2['participantIdentities'][$i]['player']['summonerName'] . '</a></td>
                                    <td class="center">' . $data_match2['participants'][$i]['stats']['kills'] . ' / ' . $data_match2['participants'][$i]['stats']['deaths'] . ' / ' . $data_match2['participants'][$i]['stats']['assists'] . ' ' . $fb . ' ' . $tw . '</td>
                                    <td class="center">' . $data_match2['participants'][$i]['stats']['totalMinionsKilled'] . '</td>
                                    <td class="center">' . $data_match2['participants'][$i]['stats']['goldEarned'] . '</td>
                                    <td class="center">' . $data_match2['participants'][$i]['stats']['totalDamageDealtToChampions'] . '</td>
                                    <td class="center">' . $data_match2['participants'][$i]['stats']['visionScore'] . '</td>
                                    <td>
                        
                ';
            for ($j = 0; $j < 7; ++$j) {
                if ($data_match2['participants'][$i]['stats']['item' . $j . ''] != 0) {
                    print '
                        <img src="resources/items/' . $data_match2['participants'][$i]['stats']['item' . $j . ''] . '.png" width="36" height="36">
                    ';
                }
            }
            print '
                                </td>
                            </tr>
            ';
            $fb = null;
            $tw = null;
        }
        print '
                    <tr>
                        <td colspan="10">
                        Bans: &nbsp;
                    ';
        for ($i = 0; $i < 5; ++$i) {
            print '
                                <img src="resources/champion_icons/' . ucfirst($arrayID[$data_match2['teams'][0]['bans'][$i]['championId']]) . '.png" width="36" height="36" rel="tooltip" title="' . $array[$data_match2['teams'][0]['bans'][$i]['championId']] . '">
                            ';
        }
        if ($data_match2['teams'][0]['win'] == 'Fail') {
            print '
                <img id="winlose" src="resources/defeat.png" width="115" height="60">
            ';
        } else {
            print '
                <img id="winlose" src="resources/victory.png" width="120" height="60">
            ';
        }
        print '             
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-borderless" id="matchTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="center">Champion</th>
                                        <th scope="col" class="center">Spells & Rune tree</th>
                                        <th scope="col" class="center">Level</th>
                                        <th scope="col" class="center">Summoner</th>
                                        <th scope="col" class="center">Stats</th>
                                        <th scope="col" class="center">Minions Killed</th>
                                        <th scope="col" class="center">Gold Earned</th>
                                        <th scope="col" class="center">Damage to Champions</th>
                                        <th scope="col" class="center">Vision Score</th>
                                        <th scope="col">Items</th>
                                    </tr>
                                </thead>
                                <tbody>
                ';

        for ($i = 5; $i < 10; ++$i) {
            if ($data_match2['participants'][$i]['stats']['firstBloodKill'] == 'true') {
                $fb = "<img src='resources/fb.png' width='20' height='20' rel='tooltip' title='First Blood'>";
            }
            if ($data_match2['participants'][$i]['stats']['firstTowerKill'] == 'true') {
                $tw = "<img src='resources/tower.png' width='20' height='24' rel='tooltip' title='First Tower'>";
            }
            print '
                                    <tr>
                                        <td class="center"><img src="resources/champion_icons/' . ucfirst($arrayID[$data_match2['participants'][$i]['championId']]) . '.png" width="42" height="42" rel="tooltip" title="' . $array[$data_match2['participants'][$i]['championId']] . '"></td>
                                        <td class="center">
                                            <img src="resources/summoner_spells/' . $data_match2['participants'][$i]['spell1Id'] . '.png" width="32" height="32">
                                            <img src="resources/summoner_spells/' . $data_match2['participants'][$i]['spell2Id'] . '.png" width="32" height="32">
                                            <img src="resources/runes/' . $data_match2['participants'][$i]['stats']['perkPrimaryStyle'] . '.png" width="24" height="24">
                                        </td>
                                        <td class="center">' . $data_match2['participants'][$i]['stats']['champLevel'] . '</td>
                                        <td class="center"><a href="../summoner.php?summoner=' . $data_match2['participantIdentities'][$i]['player']['summonerName'] . '&server=' . $server . '">' . $data_match2['participantIdentities'][$i]['player']['summonerName'] . '</a></td>
                                        <td class="center">' . $data_match2['participants'][$i]['stats']['kills'] . ' / ' . $data_match2['participants'][$i]['stats']['deaths'] . ' / ' . $data_match2['participants'][$i]['stats']['assists'] . ' ' . $fb . ' ' . $tw . '</td>
                                        <td class="center">' . $data_match2['participants'][$i]['stats']['totalMinionsKilled'] . '</td>
                                        <td class="center">' . $data_match2['participants'][$i]['stats']['goldEarned'] . '</td>
                                        <td class="center">' . $data_match2['participants'][$i]['stats']['totalDamageDealtToChampions'] . '</td>
                                        <td class="center">' . $data_match2['participants'][$i]['stats']['visionScore'] . '</td>
                                        <td>
                    ';
            for ($j = 0; $j < 7; ++$j) {
                if ($data_match2['participants'][$i]['stats']['item' . $j . ''] != 0) {
                    print '
                            <img src="resources/items/' . $data_match2['participants'][$i]['stats']['item' . $j . ''] . '.png" width="36" height="36">
                        ';
                }
            }
            print '
                                    </td>
                                </tr>
                ';
            $fb = null;
            $tw = null;
        }
        print '
                <tr>
                    <td colspan="10">
                    Bans: &nbsp;
                ';
        for ($i = 0; $i < 5; ++$i) {
            print '
                            <img src="resources/champion_icons/' . ucfirst($arrayID[$data_match2['teams'][1]['bans'][$i]['championId']]) . '.png" width="36" height="36" rel="tooltip" title="' . $array[$data_match2['teams'][1]['bans'][$i]['championId']] . '">
                        ';
        }
        if ($data_match2['teams'][1]['win'] == 'Fail') {
            print '
                    <img id="winlose" src="resources/defeat.png" width="115" height="60">
                ';
        } else {
            print '
                    <img id="winlose" src="resources/victory.png" width="120" height="60">
                ';
        }
        print '             
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
			';

        ?>
        <a href="../">Return to main menu</a>
    </div>
</body>

</html>
<?php
ob_end_flush();
?>