<?php
	$ldap_dn = "cn=admin,dc=example,dc=com";
	$ldap_pass = "root";

	$ldap_con = ldap_connect("192.168.100.1",389);

	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

	if (ldap_bind($ldap_con,$ldap_dn,$ldap_pass)) {
		$cari = "(objectclass=inetOrgPerson)";
		$hasil = ldap_search($ldap_con, "dc=example,dc=com", $cari) or exit("tidak ada data");
		$data = ldap_get_entries($ldap_con, $hasil);
       
       
        // iterate over array and print data for each entry
        echo '<h1>Show me the users</h1>';
        for ($i=0; $i<$data["count"]; $i++) {
            //echo "dn is: ". $data[$i]["dn"] ."<br />";
            echo "User: ". $data[$i]["cn"][0] ."<br />";
            if(isset($data[$i]["mail"][0])) {
                echo "Email: ". $data[$i]["mail"][0] ."<br /><br />";
            } else {
                echo "Email: None<br /><br />";
            }
        }
	}else{
		echo "gagal";
	}

?>
