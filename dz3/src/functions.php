<?php
function getConnection()
{
    global $pdo;
    if (empty($pdo)) {
        $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=" . CHARSET;
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $pdo = new PDO($dsn, USER, PASSWORD, $opt);
    }
    return $pdo;
}

//function dbConnection()
//{
//    $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME;
//    return new PDO($dsn, USER, PASSWORD);
//}

/**
 * @param array $data
 * @return array
 */
function validateData(array $data)
{
    $errors = [];
    $result = [];

    if (empty($data['name'])) {
        $errors[] = ['code' => 10001, 'message' => 'Отсутствует или не заполнено поле "Имя"'];
    } else {
        $result['name'] = trim($data['name']);
    }
    if (empty($data['phone'])) {
        $errors[] = ['code' => 10002, 'message' => 'Отсутствует или не заполнено поле "Телефон"'];
    } else {
        $result['phone'] = trim($data['phone']);
    }
    if (empty($data['email'])) {
        $errors[] = ['code' => 10003, 'message' => 'Отсутствует или не заполнено поле "e-mail"'];
    } else {
        $result['email'] = mb_strtoupper(($data['email']));
    }
    if (empty($data['street'])) {
        $errors[] = ['code' => 10004, 'message' => 'Отсутствует или не заполнено поле "Улица"'];
    } else {
        $result['street'] = trim($data['street']);
    }
    if (empty($data['home'])) {
        $errors[] = ['code' => 10005, 'message' => 'Отсутствует или не заполнено поле "Дом"'];
    } else {
        $result['home'] = trim($data['home']);
    }
    $result['part'] = isset($data['part']) ? trim($data['part']) : '';
    if (empty($data['appt'])) {
        $errors[] = ['code' => 10006, 'message' => 'Отсутствует или не заполнено поле "Квартира"'];
    } else {
        $result['appt'] = trim($data['appt']);
    }
    if (empty($data['floor'])) {
        $errors[] = ['code' => 10007, 'message' => 'Отсутствует или не заполнено поле "Этаж"'];
    } else {
        $result['floor'] = trim($data['floor']);
    }
    $result['comment'] = isset($data['comment']) ? trim($data['comment']) : '';
    if (empty($data['payment'])) {
        $result['payment'] = 1;
    } else {
        $result['payment'] = $data['payment'] == 'cach' ? 1 : 2;
    }
    $result['callback'] = isset($data['callback']);

    if (!empty($errors)) {
        return ['error' => $errors];
    }
    return ['result' => $result];
}

/**
 * @param $email
 * @return int
 */
function getUserIDByEmail($email)
{
    $sth = getConnection()->prepare("SELECT id FROM users WHERE email = :email");
    $sth->execute([':email' => $email]);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        return 0;
    }
    return (int) $result['id'];
}

/**
 * @param array $data
 * @return mixed
 */
function addUser(array $data)
{
    $val = [
        'name' => $data['name'],
        'phone' => $data['phone'],
        'email' => $data['email']
    ];
    $sql = "INSERT INTO users (`name`, phone, email) VALUES (:name, :phone, :email)";
    $sth = getConnection()->prepare($sql);
    return $sth->execute($val);
}

/**
 * @param array $data
 * @return mixed
 */
function addOrder(array $data)
{
    $val = [
        'userID' => $data['userID'],
        'street' => $data['street'],
        'home' => $data['home'],
        'part' => $data['part'],
        'appt' => $data['appt'],
        'floor' => $data['floor'],
        'date' => $data['date'],
        'payment' => $data['payment'],
        'callback' => $data['callback'],
        'comment' => $data['comment']
    ];

    $sql = "INSERT INTO orders (user_id, street, home, part, appt, floor, `date`, payment, callback, comment) 
            VALUES (:userID, :street, :home, :part, :appt, :floor, :date, :payment, :callback, :comment)";
    $sth = getConnection()->prepare($sql);
    return  $sth->execute($val);
}

/**
 * @param $userID
 * @return mixed
 */
function getLastOrderId($userID)
{
    $sql = "SELECT id FROM orders WHERE user_id = :userID ORDER BY id DESC LIMIT 1";
    $sth = getConnection()->prepare($sql);
    $sth->execute(['userID' => $userID]);
    return $sth->fetchColumn();
}

/**
 * @param $userID
 * @return mixed
 */
function getCountOrders($userID)
{
    $sql = "SELECT COUNT(id) FROM orders WHERE user_id = :userID";
    $sth = getConnection()->prepare($sql);
    $sth->execute(['userID' => $userID]);
    return $sth->fetchColumn();
}

/**
 * @param array $data
 * @return mixed
 */
function main(array $data)
{
    $val = validateData($data);
    if (isset($val['error'])) {
        return ['error' => $val['error']];
    }
    $val = $val['result'];

    $val['date'] = date("Y-m-d H:i:s");

    if (!getUserIDByEmail($val['email'])) {
        $success = addUser($val);
        if (!$success) {
            return ['error' => [0 => ['code' => 20001, 'message' => 'Не удалось сохранить данные о Пользователе']]];
        }
    }

    $val['userID'] = getUserIDByEmail($val['email']);
    $success = addOrder($val);
    if (!$success) {
        return ['error' => [0 => ['code' => 20002, 'message' => 'Не удалось сохранить данные о Заказе']]];
    }

    $address = "ул. {$val['street']}, дом {$val['home']},";
    if ($val['part']) {
        $address .= " кор. {$val['part']},";
    }
    $address .= " кв. {$val['appt']}, этаж {$val['floor']}";

    return ['success' => [
        'address' => $address,
        'lastOrder' => getLastOrderId($val['userID']),
        'countOrders' => getCountOrders($val['userID'])
     ]];
}
