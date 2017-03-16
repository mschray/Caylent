<?php

    require 'vendor/autoload.php';

    print("Load the environment variables\n");

    // Load environment variables
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
    $tenant_id = getenv('TENANT_ID');
    $client_id = getenv('CLIENT_ID');
    $client_secret = getenv('CLIENT_SECRET');
    $subscription_id = getenv('SUBSCRIPTION_ID');
    $resource_group_name = getenv('RESOURCE_GROUP_NAME');

    $access_token = get_auth_token($tenant_id, $client_id, $client_secret);

    dump_var("Access Token" + $access_token);

    function make_request($request_array)
    {

        $curl  = curl_init();
        curl_setopt_array($curl, $request_array);

        $resp = json_decode(curl_exec($curl));
        print("Completed auth request with status of\n");
        var_dump($resp);
        curl_close($curl);

        echo $resp;

        return $resp;


    }

    function get_auth_token($a_tenant_id, $a_client_id, $a_client_secret)
    {
        $curl_opt_array = array(
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://login.microsoftonline.com:443/$a_tenant_id/oauth2/token??api-version=1.0",
            CURLOPT_POSTFIELDS => array(
                "grant_type" => "client_credentials",
                "resource" => "https://management.core.windows.net/",
                "client_id" => "$a_client_id",
                "client_secret" => "$a_client_secret"
            ));


        print("Dump the $curl_opt_array \n");
        var_dump($curl_opt_array);


        print("Make request for auth token\n");
        $resp = make_request($curl_opt_array);
        var_dump($resp);

        $access_token = $resp->access_token;

        return $access_token;
    }      


    

    // /* Create new resource group and deploy from ARM template */
    // $data = array("location" => "eastus");
    // $data_json = json_encode($data);
    // // Initialize curl and set options
    // $curl = curl_init();
    // curl_setopt_array($curl, array(
    //     CURLOPT_CUSTOMREQUEST => "PUT",
    //     CURLOPT_RETURNTRANSFER => 1,
    //     CURLOPT_HEADER => 0,
    //     CURLOPT_URL => "https://management.azure.com/subscriptions/$subscription_id/resourcegroups/$resource_group_name?api-version=2016-06-01",
    //     CURLOPT_HTTPHEADER => array(
    //         "Content-type: Application/json",
    //         "Authorization: Bearer $access_token"),
    //     CURLOPT_POSTFIELDS => $data_json
    // ));

    // $resp = curl_exec($curl);
    // print_r($resp);
    // curl_close($curl);

    // $deployment_name = "FirstCaylentDeployment3";
    // $template_uri = "https://raw.githubusercontent.com/Azure/azure-quickstart-templates/master/101-vm-simple-linux/azuredeploy.json";
    // $adminUsername = "KwadwoTest";
    // $adminPassword = "KwadwoTest123!!!";
    // $dnslabelPrefix = "caylentdeployment3";


    // /* Use arm template to create resources in created resource group */
    // $data = array(
    //     "properties" => array(
    //         "templateLink" => array(
    //             "uri" => $template_uri,
    //             "contentVersion" => "1.0.0.0"
    //             ),
    //         "mode" => "Incremental",
    //         "parameters" => array(
    //             "adminUsername" => array(
    //                 "value" => $adminUsername
    //             ),
    //             "adminPassword" => array(
    //                 "value" => $adminPassword
    //             ),
    //             "dnsLabelPrefix" => array(
    //                 "value" => $dnslabelPrefix
    //             )
    //         )
    //     )
    // );
    // $data_json = json_encode($data);
    // // Initialize curl and set options
    // $curl = curl_init();
    // $curl = curl_init();
    // curl_setopt_array($curl, array(
    //     CURLOPT_CUSTOMREQUEST => "PUT",
    //     CURLOPT_RETURNTRANSFER => 1,
    //     CURLOPT_HEADER => 0,
    //     CURLOPT_URL => "https://management.azure.com/subscriptions/$subscription_id/resourcegroups/$resource_group_name/providers/microsoft.resources/deployments/$deployment_name?api-version=2016-09-01",
    //     CURLOPT_HTTPHEADER => array(
    //         "Content-type: Application/json",
    //         "Authorization: Bearer $access_token"),
    //     CURLOPT_POSTFIELDS => $data_json
    // ));

    // $resp = json_decode(curl_exec($curl));
    // print_r($resp);
    // curl_close($curl); 
?>