<?php

    require 'AzureARMRESTAPI.php';

        require 'vendor/autoload.php';

    print("Load the environment variables\n");

    // Load environment variables

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
    $a_tenant_id = getenv('TENANT_ID');
    $a_client_id = getenv('CLIENT_ID');
    $a_client_secret = getenv('CLIENT_SECRET');
    $a_subscription_id = getenv('SUBSCRIPTION_ID');
    $a_resource_group_name = getenv('RESOURCE_GROUP_NAME');
    $azure_datacenter_location = "east us";

    $access_token = get_auth_token( $a_tenant_id, $a_client_id, $a_client_secret);
//    $result = create_resource_group($a_subscription_id,$a_resource_group_name,$access_token,$azure_datacenter_location);


    $deployment_name = "FirstCaylentDeployment3";
    $template_uri = "https://raw.githubusercontent.com/Azure/azure-quickstart-templates/master/101-vm-simple-linux/azuredeploy.json";
    $adminUsername = "KwadwoTest";
    $adminPassword = "KwadwoTest123!!!";
    $dnslabelPrefix = "caylentdeployment4";


    /* Use arm template to create resources in created resource group */
    $data = array(
        "properties" => array(
            "templateLink" => array(
                "uri" => $template_uri,
                "contentVersion" => "1.0.0.0"
                ),
            "mode" => "Incremental",
            "parameters" => array(
                "adminUsername" => array(
                    "value" => $adminUsername
                ),
                "adminPassword" => array(
                    "value" => $adminPassword
                ),
                "dnsLabelPrefix" => array(
                    "value" => $dnslabelPrefix
                )
            )
        )
    );
    $data_json = json_encode($data);

  //  $result = create_or_update_deployment($a_subscription_id, $a_resource_group_name, $deployment_name, $access_token, $data);

    //var_dump($result);

    //$result = get_list_deployment_operations($a_subscription_id, $a_resource_group_name, $deployment_name, $access_token);

    //var_dump($result);
    //$operation_id = "172217CF8D5D74E9";
    //$result = get_deployment_operation($a_subscription_id, $a_resource_group_name, $deployment_name, $operation_id ,$access_token);

    // print("List deployments\n");
    // $result = list_deployments($a_subscription_id, $a_resource_group_name, $deployment_name, $access_token);
    // var_dump($result);

    // print("Before check existence\n");
   
    // $result = check_existence($a_subscription_id, $a_resource_group_name, $deployment_name, $access_token);

    // print("Dump_check_existence");
    // var_dump($result);

    // //$result = delete_deployment($a_subscription_id, $a_resource_group_name, $deployment_name, $access_token);
   
    // //print("Dump_delete_deployment");

    // $result = export_template($a_subscription_id, $a_resource_group_name, $deployment_name, $access_token);

    // print("Dump_export_template");

    // var_dump($result);


    // $result = get_deployment($a_subscription_id, $a_resource_group_name, $deployment_name, $access_token);

    // print("Get_deployment");

    // var_dump($result);

    $result = list_subscriptions($access_token);

    var_dump($result);

    $sub_id = $result;
    print gettype($result);
    print("\n");
    var_dump(get_object_vars($result) );
    print("\n");
    var_dump($result->$displayName);

    $result = get_subscription($result->subscriptionId,$access_token);

    var_dump($result);

    //$result = list_locations("b3afec2e-9c6f-47ae-a618-5fcc40246287",$access_token);

    //var_dump($result)

?>