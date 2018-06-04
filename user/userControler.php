<?php

/* database name ==> gestion_user
  CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(255) NOT NULL,
  `passeWord` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `passeWord`) VALUES
('ana', 'ana'),
('howa', 'howa');
 
 */
// seConnecter ==>  http://127.0.0.1/projects/userManager/user/userControler.php?seConnecter&id=ana&passeWord=ana
//find ==> http://127.0.0.1/projects/userManager/user/userControler.php?find&id=ana
//findAll ==> http://127.0.0.1/projects/userManager/user/userControler.php?findAll

include_once '../frontControler.php';
$data = decode(1);
if (isset($data["find"])) {
    printEncode(findUser($data));
} else if (isset($data["findAll"])) {
    printEncode(findAllUser());
} else if (isset($data["seConnecter"])) {
   
    echo(seConnecter($data));
} 

?>