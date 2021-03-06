<?php
include 'autoload.php';
$apk = new \ApkParser\Parser('EBHS.apk');

$manifest = $apk->getManifest();
$permissions = $manifest->getPermissions();

echo '<pre>';
echo "Package Name      : " . $manifest->getPackageName() . "" . PHP_EOL;
echo "Version           : " . $manifest->getVersionName() . " (" . $manifest->getVersionCode() . ")" . PHP_EOL;
echo "Min Sdk Level     : " . $manifest->getMinSdkLevel() . "" . PHP_EOL;
echo "Min Sdk Platform  : " . $manifest->getMinSdk()->platform . "" . PHP_EOL;
echo PHP_EOL;
echo "------------- Permssions List -------------" . PHP_EOL;

// find max length to print more pretty.
$perm_keys = array_keys($permissions);
$perm_key_lengths = array_map(function ($perm) {
    return strlen($perm);
}, $perm_keys);
$max_length = max($perm_key_lengths);

foreach ($permissions as $perm => $description) {
    echo str_pad($perm, $max_length + 4, ' ') . "=> " . $description . " " . PHP_EOL;
}


echo PHP_EOL;
echo "------------- Activities  -------------" . PHP_EOL;
foreach ($apk->getManifest()->getApplication()->getActivityNameList() as $activityName) {
    echo $activityName . PHP_EOL;
}

echo PHP_EOL;
echo "------------- All Classes List -------------" . PHP_EOL;
foreach ($apk->getClasses() as $className) {
    echo $className . PHP_EOL;
}
