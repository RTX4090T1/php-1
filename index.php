<?php
// \7. Асоціативний масив “АЗС” (Код, адреса, фірма-власник, запаси  пального (у літрах) та ціни одного літру пального).
//  Запит  наявності X літрів пального,  на  АЗС вказаного власника.
// 1. Описати літерал нумерованого масиву із 5 -7 масивів з текстовими ключами, що містять дані про об'єкти згідно із варіантом .
// 2. Вивести дані про об'єкти в таблицю. 
// 3. Підготувати функцію для вибору всіх елементів масиву, що відповідають запиту. Вивести їх в таблицю.
// 4. Передбачити можливість передачі параметрів запиту через рядок стану (наприклад index.php?country=ukraine&min_age=18)
// 5. Створити форму для додавання нового об'єкту до масиву.  
// 6. Створити форму редагування даних про об'єкт.
// 7. Перед редагуванням здійснити валідацію даних (ПІБ не може бути порожнім рядком, заробітна плата повинна бути невід'ємним числом, тощо)
$azsDatas = [
    ["Code" => 88001, "Owner" => "OKKO", "FuelCapacity" => 1030000, "PricePerLiter" => 39.7],
    ["Code" => 88002, "Owner" => "OKKO", "FuelCapacity" => 1070000, "PricePerLiter" => 40.7],
    ["Code" => 88003, "Owner" => "WOG", "FuelCapacity" => 1080000, "PricePerLiter" => 50.3],
    ["Code" => 88004, "Owner" => "UPG", "FuelCapacity" => 190000, "PricePerLiter" => 39.1],
    ["Code" => 88005, "Owner" => "UKRNAFTA", "FuelCapacity" => 1000000, "PricePerLiter" => 39.3],
    ["Code" => 88006, "Owner" => "MARKET", "FuelCapacity" => 10000, "PricePerLiter" => 39.8]
];
function FilterBYOwner($azs, $owner) {
    $filteredazs = [];
    foreach ($azs as $azsEl) {
        if ($azsEl["Owner"] == $owner) {
            $filteredazs[] = $azsEl; 
        }
    }
    return $filteredazs;
}

$list = [];
if (!empty($_GET["inputOwner"])) {
    $list = FilterBYOwner($azsDatas, trim($_GET["inputOwner"]));
}


function Select($lst1, $lst2) {
    return count($lst1) > 0 ? $lst1 : $lst2;
}

$newAzs = [];
if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $newAzs = [
        'Code'=> $_POST['code'] ?? '',
        'Owner'=> $_POST['name'] ?? '',
        'FuelCapacity'=> $_POST['capacity'] ?? '',
        'PricePerLiter'=> $_POST['price'] ?? ''
    ];
    if (isset($_POST['submit'])){
        
    }
    if($_POST['submit'] == 'Add'){
        $azsDatas[] = $newAzs;
    }
    
}
function Redact($index){
    return $index; 
}
$indexToReadct = Redact($_POST["index"]);
if (isset($_POST['submit'])){
    if($_POST['submit'] == 'Redact'){
    if ($indexToReadct > 0) {
    $azsDatas[$indexToReadct]["Code"] = $_POST['code'];
    $azsDatas[$indexToReadct]["Owner"] = $_POST['name'];
    $azsDatas[$indexToReadct]["FuelCapacity"] = $_POST['capacity'];
    $azsDatas[$indexToReadct]["PricePerLiter"] = $_POST['price'];
}
}
}

$displayList = Select($list, $azsDatas);

include("layout.phtml");











