<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Sheets;
use Illuminate\Http\Request;

class GoogleSheetService extends Controller
{
    private $client;
    private $service;

    function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setApplicationName("Periodic Table");
        $this->client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(resource_path("credential.json"));
        $this->service = new Google_Service_Sheets($this->client);
    }

    public function getDataSheets() {
        $spreadsheet = $this->service->spreadsheets_values->get(env("GOOGLE_SPREADSHEET_ID"),'Sheet1');
        $result = $spreadsheet->getValues();
        return $result;
    }
}
