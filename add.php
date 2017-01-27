<?php
	$ldap_dn = "cn=admin,dc=openldap,dc=com";
	$ldap_pass = "root";

	$ds = ldap_connect("10.0.2.15",389);

	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	
	if ($ds) {
    // bind with appropriate dn to give update access
    $r = ldap_bind($ds, $ldap_dn, $ldap_pass);

    // prepare data
    $info["cn"] = "tata";
    $info["sn"] = "tata";
    $info["objectclass"] = "inetOrgPerson";
    $info["userPassword"] = '{SHA}' . base64_encode(pack('H*',sha1("jangkrik")));;
    $info["uid"] = "tata";

    // add data to directory
    $r = ldap_add($ds, "cn=tata, cn=user-group,ou=user,cn=admin,dc=ldap,dc=com", $info);

    ldap_close($ds);
} else {
    echo "Unable to connect to LDAP server";
}

?>
