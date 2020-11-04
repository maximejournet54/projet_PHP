DROP FUNCTION IF EXISTS `creation_redacteur`
CREATE FUNCTION `creation_redacteur` (`nom` VARCHAR(50) CHARSET utf16, `prenom` VARCHAR(50) CHARSET utf16, `mail_in` VARCHAR(50) CHARSET utf16, `mdp` VARCHAR(50) CHARSET utf16) RETURNS INT(2) MODIFIES SQL DATA
BEGIN
DECLARE pb INT DEFAULT 0;
DECLARE mail_bdd Varchar(50);

DECLARE fincurs1 BOOLEAN DEFAULT 0;
DECLARE curs1 CURSOR FOR
    Select adressemail From redacteur;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET fincurs1:=1;

OPEN curs1;
FETCH curs1 into mail_bdd;
WHILE NOT fincurs1 DO
    
   
   IF mail_bdd = mail_in
   THEN Set pb:=1;
         SET fincurs1 :=1;   
    
    ELSEIF mail_bdd = mail_in
    THEN Set pb:=2;
         SET fincurs1 :=1;
    END IF;
    
    
FETCH curs1 into mail_bdd;
END WHILE;

IF pb=0
THEN 
INSERT INTO redacteur(nom,prenom,adressemail,motdepasse) VALUES(nom,prenom,mail_in,mdp);
END IF;
return pb;
END