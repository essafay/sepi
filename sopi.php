<?php
date_default_timezone_set('Asia/Jakarta');

$cookiesFilePath = '__LOCALE__null=ID; csrftoken=wpg3wF4LBZuJIyAViTwxIMVvBBwYqHzZ; _QPWSDCXHZQA=45bc2035-476c-43ef-c64c-76cbc07b14c9; REC7iLP4Q=550adaf6-2658-470b-902d-27c30273ed82; SPC_F=9EIxG2azxDo7K9hf5QHaVaNs8588aMEQ; REC_T_ID=9919af70-14de-11ef-bb58-d652718fd5ff; SPC_SI=xk4vZgAAAAB0dXl2QXVvS97VaAEAAAAAT3RaOGE4ZUE=; SPC_SEC_SI=v1-NTA2cWQyYmVXbWl6aVExSrB3txa4x4RRUZ4QWh4B3rWEDdswDJNedpAcgFKHbFx+8J4RbzFXQmFNjvZFN4mQRb1S9io0H3/oJNb6UuOafsc=; _sapid=f7a5c1c981ed89af293d23497590557f147682b17b4b256a6be20637; _gcl_au=1.1.1306071531.1716013178; _fbp=fb.2.1716013179013.1887407425; AMP_TOKEN=$NOT_FOUND; _gid=GA1.3.2078590431.1716013180; SPC_CLIENTID=OUVJeEcyYXp4RG83jmjthmwvyyfcbvpy; SPC_EC=.ZnNkUDZuVGpYNEFsNDVtWTxsFex5zNinrfqPOEaWHe7CSJ1kNWykkv4fag0o3qI+RySE9wZMhfJ7XAi6YCZ5VcRCuEWNv9esTMgFBuxWSkhaY4mHVKwUsSWtAh/je81SEvyBUi/jB3lUdkAmPE/9jrj7tpw/oxusZp3Z2uHZPWf35+FMco+GV+KJXvBpcvYCecLx1UBPxczS6NEbs0+QZA==; SPC_ST=.ZnNkUDZuVGpYNEFsNDVtWTxsFex5zNinrfqPOEaWHe7CSJ1kNWykkv4fag0o3qI+RySE9wZMhfJ7XAi6YCZ5VcRCuEWNv9esTMgFBuxWSkhaY4mHVKwUsSWtAh/je81SEvyBUi/jB3lUdkAmPE/9jrj7tpw/oxusZp3Z2uHZPWf35+FMco+GV+KJXvBpcvYCecLx1UBPxczS6NEbs0+QZA==; _dc_gtm_UA-61904553-8=1; _gcl_aw=GCL.1716013259.EAIaIQobChMI_tDGnMeWhgMVVAuDAx3zGQSbEAAYASAAEgJgL_D_BwE; _med=cpc; SPC_U=403490306; SPC_R_T_ID=SqMWWpyVybBTj8vrk9iLCZC+TnCixOHiPAOBti6FugZhh/yYUWd9WdQ60zjDLRO/48V+VVqb2ZW/AeB2kdz+TROg3PAnFJV6GvYVhcWqBpmm93nlHRO5NxZlmbyfpbNQLZFxStoekuj3daYFDKZvntRY2aS0pHF2xEz/m1/pTMM=; SPC_R_T_IV=eEZ1VXJzYmpCa29YalBZUA==; SPC_T_ID=SqMWWpyVybBTj8vrk9iLCZC+TnCixOHiPAOBti6FugZhh/yYUWd9WdQ60zjDLRO/48V+VVqb2ZW/AeB2kdz+TROg3PAnFJV6GvYVhcWqBpmm93nlHRO5NxZlmbyfpbNQLZFxStoekuj3daYFDKZvntRY2aS0pHF2xEz/m1/pTMM=; SPC_T_IV=eEZ1VXJzYmpCa29YalBZUA==; SPC_IA=1; shopee_webUnique_ccd=7pfAOUxoSiM3RDswS3Q0fA==|C9sONKkQjxWN+k3psuIsC4SJqR47kZQ3vjyOnH4e6o+qwdi8oGSptmNW3U20iy7k0iNH3b6VuOSRS4H5|47pN8C/4ch7swnAy|08|3; ds=f704f7691b4285ecf36c287142fa9d8e; _ga_SW6D8G0HXK=GS1.1.1716013178.1.1.1716013278.40.0.0; _ga=GA1.3.554781445.1716013179';
$cookies = readCookiesFromFile($cookiesFilePath);
$chatId = "160073776";
$botToken = "6832846669:AAEfZ839Br7nqeCt-va0ZO3FCfidimcIb34";
$delay = "2"; // ATUR DELAY LOOPING SESUKA LU DISINI


cekAkun();
cekStock();

while (true) {
    $idBarang = readline('MASUKKAN ID BARANG => : ');
    if (empty($idBarang)) {
        echo "ID BARANG KOSONG!! SILAHKAN DIISI!!\n";
        continue;
    }
    cekId($idBarang);
}

function cekAkun()
{
    global $cookies, $userid, $username, $email;

    $sessionUrl = "https://shopee.co.id/api/v4/account/basic/get_account_info";

    $options = [
        'http' => [
            'method' => 'GET',
            'header' => getHeaders([
                'Cookie' => $cookies
            ]),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($sessionUrl, false, $context);
    $response = json_decode($response, true);

    if ($response['error'] === 0) {
        $userid = $response['data']['userid'];
        $username = $response['data']['username'];
        $email = $response['data']['email'];
        echo "DATA AKUN:\nUSERNAME: $username\nEMAIL: $email\n\n";
    }
}

function cekStock()
{
    global $cookies, $userid;

    $sessionUrl = "https://idgame.shopee.co.id/api/buyer-mission/v2/quests/f32fb098ab94baef/store/items";

    $options = [
        'http' => [
            'method' => 'GET',
            'header' => getHeaders([
                'x-user-id' => $userid,
                'Cookie' => $cookies
            ]),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($sessionUrl, false, $context);
    $response = json_decode($response, true);

    if ($response['code'] === 0) {
        $processedNames = [];
        foreach ($response['data']['item_list'] as $item) {
            $nameUpper = strtoupper($item['name']);
            if (!in_array($nameUpper, $processedNames)) {
                $processedNames[] = $nameUpper;
                $idBarang = $item['id'];
                $status = $item['redeem_status'] == 1 ? 'HABIS!!' : 'READY!!';
                $cost = isset($item['cost']) ? $item['cost'] : (isset($item['points_to_redeem']) ? $item['points_to_redeem'] : 'N/A');
                echo "[+] ID: {$idBarang} NAME: {$nameUpper} | HARGA: {$cost} POINT => {$status}\n";
            }
        }
    } else {
        echo "Error: Unexpected response code " . $response['code'] . "\n";
    }
}

function cekId($targetId)
{
    global $cookies, $userid, $username, $botToken, $chatId, $delay;

    while (true) {
        $sessionUrl = "https://idgame.shopee.co.id/api/buyer-mission/v2/quests/f32fb098ab94baef/store/items";

        $options = [
            'http' => [
                'method' => 'GET',
                'header' => getHeaders([
                    'x-user-id' => $userid,
                    'Cookie' => $cookies
                ]),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($sessionUrl, false, $context);
        $response = json_decode($response, true);

        if (isset($response['data']['item_list'])) {
            foreach ($response['data']['item_list'] as $item) {
                if ($item['id'] == $targetId) {
                    $itemName = strtoupper($item['name']);
                    if ($item['redeem_status'] == 1) {
                        echo "[" . date('H:i:s') . "] BARANG ITEM ID: ({$targetId}) HABIS / BELUM TERSEDIA!!\n";
                    } else if ($item['redeem_status'] === 0) {
                        $redeemUrl = "https://idgame.shopee.co.id/api/buyer-mission/v2/quests/f32fb098ab94baef/store/redeem/$targetId";

                        $redeemOptions = [
                            'http' => [
                                'method' => 'POST',
                                'header' => getHeaders([
                                    'x-user-id' => $userid,
                                    'Cookie' => $cookies
                                ]),
                            ],
                        ];

                        $redeemContext = stream_context_create($redeemOptions);
                        $redeemResponse = file_get_contents($redeemUrl, false, $redeemContext);
                        $redeemResponse = json_decode($redeemResponse, true);

                        if ($redeemResponse['code'] === 0 && $redeemResponse['data']['code'] == 0) {
                            $point = $redeemResponse['data']['remain_score'];
                            echo "[+] [" . date('H:i:s') . "] " . strtoupper($redeemResponse['msg']) . " CLAIM BARANG {$itemName} | ID: ({$targetId})!! POINT TERSISA: {$point}\n";
                            sendTelegramMessage($username, $itemName, $targetId, $point);
                        } else {
                            echo "[!] [" . date('H:i:s') . "] " . strtoupper($redeemResponse['msg']) . " CLAIM BARANG ID: ({$targetId}) GAGAL!!!!\n";
                        }
                    }
                }
            }
        } else {
            echo "[" . date('H:i:s') . "] BARANG YANG DICLAIM HABIS ATAU BARANG ITEM ID YANG DIMASUKKAN TIDAK DITEMUKAN!!\n";
        }

        sleep($delay);
    }
}

function sendTelegramMessage($username, $itemName, $itemId, $point)
{
    global $botToken, $chatId;

    $date = date("d-M");
    $message = "BERHASIL CLAIM BARANG!! ( ID: " . strtoupper($username) . " )\nTIME: $date " . date('H:i:s') . "\nBARANG:\n{$itemName} -  ( {$itemId} )\nPOINT TERSISA: {$point}";

    $telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($telegramApiUrl, false, $context);

    if ($result === false) {
        echo "GAGAL MENGIRIM PESAN KE TELEGRAM!\n";
    } else {
        echo "[" . date('H:i:s') . "] BERHASIL MENGIRIM PESAN KE TELEGRAM!!\n";
    }
}

function readCookiesFromFile($filePath)
{
    try {
        $cookies = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($cookies === false) {
            error_log('ERROR!! GAGAL MEMBACA DATA COOKIE DARI FILE: ' . $filePath);
            return null;
        }
        return implode('; ', $cookies);
    } catch (Exception $error) {
        error_log('ERROR!! GAGAL MEMBACA DATA COOKIE DARI FILE!!');
        return null;
    }
}

function getHeaders($additionalHeaders = [])
{
    $defaultHeaders = [
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
        'Accept: application/json, text/plain, */*',
        'accept-language: en-US,en;q=0.9,id;q=0.8',
        'affiliate-program-type: 1',
        'dnt: 1',
        'priority: u=1, i',
        'sec-ch-ua: "Chromium";v="124", "Google Chrome";v="124", "Not-A.Brand";v="99"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-origin',
    ];

    foreach ($additionalHeaders as $key => $value) {
        $defaultHeaders[] = "$key: $value";
    }

    return implode("\r\n", $defaultHeaders);
}
