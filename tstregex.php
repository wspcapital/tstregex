<!DOCTYPE html>
<html>
<head>
    <title>Test Task</title>
</head>
<body>
<div class="form-wrap">
    <form method="post">
    <input type="text" name="address" value="Flat 1 9 Lotus Court"/>
    <input type="submit" value="submit"/>
</form>
</div>
<div class="resp">
    <?php
    $aFlatAlts = [
        'Apartment',
        'Apt',
        'Basement Falt',
        'Flat',
        'G\/',
        'Garden Flat',
        'Ground Floor Flat',
        'Lower Flat',
    ];
    $sFlatAlts = implode('\s*\d+|',$aFlatAlts) . '\s*\d+';
    if(!empty($_POST['address'])) {
        $sFlat = 'undefined';
        $sAddr = trim($_POST['address']);
        $bFlat = preg_match_all("/(" . $sFlatAlts . ")/is",$sAddr,$aFlat, PREG_PATTERN_ORDER);
        if(!empty($aFlat[0][0])) {
            $sFlat = trim($aFlat[0][0]);
            $homeStr = str_replace($sFlat, "", $sAddr);
        } else {
            $homeStr = $sAddr;
        }
        $sHome = 'undefined';
        $bHomestr = preg_match_all("/([0-9][A-Za-z]?\-?)+/is", $homeStr, $aHome, PREG_PATTERN_ORDER);
        if($bHomestr) {
            $sHome = trim($aHome[0][0]);
        }
        $sStreet = trim(str_replace($sHome, "", $homeStr));
        $aAddr = [
                'flat' => $sFlat,
                'home' => $sHome,
                'street'=> preg_replace("/\,*/", "", $sStreet)];
        echo '<pre/>';
        print_r($aAddr);
    }
    ?>
</div>
<style>
    html,
    body,
    {
        height: 100%;
    }

    .form-wrap{
        height:200px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-wrap input[type="text"]{
        height: 35px;
        width: 300px;
        padding: 0 5px;
        font-size: 1.2em;
    }

    .form-wrap input[type="submit"]{
        padding: 10px 30px;
        font-size: 1.1em;
        background: #7db379c7;
        border-radius: 3px;
        border: 0;
        box-shadow: 0 0 5px;
    }
    .resp{
        margin: 0 auto;
        width: 20%;
    }
</style>
</body>
</html>

