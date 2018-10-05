<form method="post">
    <input type="text" name="address" value="Flat 1 9 Lotus Court"/>
    <input type="submit" value="submit"/>
</form>

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
